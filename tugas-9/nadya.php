<?php
// ===============
// NAMESPACE & AUTOLOADING
// ===============
namespace PerpustakaanApp;

spl_autoload_register(function ($class) {
    $prefix = __NAMESPACE__ . '\\';
    $base_dir = __DIR__ . '/';
    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) return;
    $relative_class = substr($class, $len);
    $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';
    if (file_exists($file)) require $file;
});


// ===============
// TRAIT
// ===============
trait CetakLabel {
    public function cetakLabel(): string {
        return "Judul: {$this->judul}, Harga: Rp " . number_format($this->getHarga(), 0, ',', '.');
    }
}


// ===============
// INTERFACE
// ===============
interface InfoItem {
    public function getInfo(): string;
}


// ===============
// ABSTRACT CLASS
// ===============
abstract class Item implements InfoItem, \IteratorAggregate, \JsonSerializable {
    protected string $judul;
    protected float $harga;

    // CLASS CONSTANT tambahan
    public const KATEGORI = "Perpustakaan Umum";
    public const TIPE = ["BUKU", "MAJALAH", "LAINNYA"];

    public static int $jumlahItem = 0;

    public function __construct(string $judul, float $harga) {
        $this->judul = $judul;
        $this->setHarga($harga);
        self::$jumlahItem++;
    }

    public function __destruct() {
        echo "\n(Objek {$this->judul} dihapus)";
    }

    public function setHarga(float $harga): void {
        if ($harga < 0) throw new \Exception("Harga tidak boleh negatif!");
        $this->harga = $harga;
    }
    public function getHarga(): float { return $this->harga; }

    public function __toString(): string {
        return "{$this->judul} - Rp " . number_format($this->harga, 0, ',', '.');
    }

    // Magic method
    public function __get($prop) { return $this->$prop ?? null; }
    public function __set($prop, $val) { $this->$prop = $val; }
    public function __call($name, $args) { return "Method '$name' tidak ditemukan!"; }

    // IteratorAggregate
    public function getIterator(): \Traversable {
        return new \ArrayIterator(get_object_vars($this));
    }

    // Serialization (PHP native)
    public function __sleep(): array { return ['judul', 'harga']; }
    public function __wakeup(): void { $this->judul = "[unserialized] " . $this->judul; }

    // JSON Serialization (tambahan)
    public function jsonSerialize(): mixed {
        return [
            'judul' => $this->judul,
            'harga' => $this->harga,
            'kategori' => self::KATEGORI
        ];
    }

    // Cloning
    public function __clone() { $this->judul .= " (Copy)"; }

    // Static
    public static function getJumlahItem(): int { return self::$jumlahItem; }

    abstract public function getInfo(): string;
}


// ===============
// CLASS TURUNAN
// ===============
class Buku extends Item {
    use CetakLabel;
    public function getInfo(): string {
        return "Buku: " . parent::__toString();
    }
}

class Majalah extends Item {
    use CetakLabel;
    public function getInfo(): string {
        return "Majalah: " . parent::__toString();
    }
}


// ===============
// DEPENDENCY INJECTION
// ===============
class AdminService {
    private $admin;

    // Dependency Injection melalui konstruktor
    public function __construct(Admin $admin) {
        $this->admin = $admin;
    }

    public function tampilkanTotal(array $items): string {
        $total = $this->admin::hitungTotal($items);
        return "Total harga koleksi: Rp " . number_format($total, 0, ',', '.');
    }
}


// ===============
// FINAL CLASS
// ===============
final class Admin {
    public static function hitungTotal(array $items): float {
        $total = 0;
        foreach ($items as $i) $total += $i->getHarga();
        return $total;
    }
}


// ===============
// PROGRAM UTAMA
// ===============
try {
    $b1 = new Buku("Pemrograman PHP", 75000);
    $m1 = new Majalah("Tech Monthly", 25000);
    $koleksi = [$b1, $m1];

    echo "=== Koleksi Perpustakaan ===\n";
    foreach ($koleksi as $item) echo $item->getInfo() . "\n";

    echo "\nTotal Koleksi: " . Item::getJumlahItem();

    // Trait
    echo "\nLabel Buku: " . $b1->cetakLabel();

    // Dependency Injection
    $adminService = new AdminService(new Admin());
    echo "\n" . $adminService->tampilkanTotal($koleksi);

    // Cloning
    $b2 = clone $b1;
    echo "\nClone Buku: " . $b2->getInfo();

    // Serialization
    $ser = serialize($m1);
    echo "\nSerialized Majalah: $ser";
    $m2 = unserialize($ser);
    echo "\nUnserialized Majalah: " . $m2->getInfo();

    // JSON Serialization
    echo "\nJSON Koleksi: " . json_encode($koleksi, JSON_PRETTY_PRINT);

    // Reflection
    echo "\n\n=== REFLECTION INFO ===\n";
    $refClass = new \ReflectionClass(Buku::class);
    echo "Nama Class: " . $refClass->getName() . "\n";
    echo "Properti:\n";
    foreach ($refClass->getProperties() as $prop) {
        echo "- " . $prop->getName() . "\n";
    }

    // Anonymous class
    $anon = new class("Novel Misteri", 50000) extends Buku {};
    echo "\nAnonymous Class Item: " . $anon->getInfo();

} catch (\Exception $e) {
    echo "Error: " . $e->getMessage();
} finally {
    echo "\nProgram selesai.\n";
}

?>