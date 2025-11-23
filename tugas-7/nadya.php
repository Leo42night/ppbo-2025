
<?php

trait CetakLabel {
    public function cetakLabel(): string {
        return "Judul: {$this->judul}, Harga: Rp " . number_format($this->getHarga(), 0, ',', '.');
    }
}


interface InfoItem {
    public function getInfo(): string;
}


abstract class Item implements InfoItem, IteratorAggregate {
    protected string $judul;
    protected float $harga;
    public const KATEGORI = "Perpustakaan";

    public static int $jumlahItem = 0;

    public function __construct(string $judul, float $harga) {
        $this->judul = $judul;
        $this->setHarga($harga);
        self::$jumlahItem++;
    }

    public function __destruct() {
        echo "\n (Objek {$this->judul} dihapus)";
    }

    public function setHarga(float $harga): void {
        if ($harga < 0) {
            throw new Exception("Harga tidak boleh negatif!");
        }
        $this->harga = $harga;
    }
    public function getHarga(): float {
        return $this->harga;
    }


    public function __toString(): string {
        return "{$this->judul} - Rp " . number_format($this->harga, 0, ',', '.');
    }
    public function __get($prop) { return $this->$prop ?? null; }
    public function __set($prop, $val) { $this->$prop = $val; }
    public function __call($name, $args) {
        return "Method '$name' tidak ditemukan!";
    }

    // IteratorAggregate
    public function getIterator(): Traversable {
        return new ArrayIterator(get_object_vars($this));
    }

    // Serialization
    public function __sleep(): array { return ['judul', 'harga']; }
    public function __wakeup(): void { $this->judul = "[unserialized] " . $this->judul; }

    // Cloning
    public function __clone() {
        $this->judul .= " (Copy)";
    }

    // Static
    public static function getJumlahItem(): int {
        return self::$jumlahItem;
    }

    // Abstract Method
    abstract public function getInfo(): string;
}

// ===============
// Class Turunan
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
// Final Class
// ===============
final class Admin {
    public static function hitungTotal(array $items): float {
        $total = 0;
        foreach ($items as $i) {
            $total += $i->getHarga();
        }
        return $total;
    }
}

try {
    $b1 = new Buku("Pemrograman PHP", 75000);
    $m1 = new Majalah("Tech Monthly", 25000);

    $koleksi = [$b1, $m1];

    echo "=== Koleksi Perpustakaan ===\n";
    foreach ($koleksi as $item) {
        echo $item->getInfo() . "\n "; // Polymorphism
    }

    echo "\nTotal Koleksi: " . Item::getJumlahItem();

    // Trait
    echo "\nLabel Buku: " . $b1->cetakLabel();

    // Static + Final
    echo "\n Total Harga Koleksi: Rp " . number_format(Admin::hitungTotal($koleksi),0,',','.');

    // Cloning
    $b2 = clone $b1;
    echo "\nClone Buku: " . $b2->getInfo();

    // Serialization
    $ser = serialize($m1);
    echo "\nSerialized Majalah: $ser";
    $m2 = unserialize($ser);
    echo "\nUnserialized Majalah: " . $m2->getInfo();

    // Iterasi properti
    echo "\nIterasi properti Buku:\n";
    foreach ($b1 as $k => $v) {
        echo "$k : $v\n";
    }

    // Anonymous class
    $anon = new class("Novel Misteri", 50000) extends Buku {};
    echo "\n Anonymous Class Item: " . $anon->getInfo();

} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
} finally {
    echo "\n Program selesai.";
}

?>
