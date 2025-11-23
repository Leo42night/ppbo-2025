<?php
define("APP_NAME", "DollieMooi Photobox");
define("VERSION", "1.0");

trait Logger {
    public function log($message) {
        echo "[LOG] " . date("Y-m-d H:i:s") . " - $message\n";
    }
}

class Photobox {
    use Logger;

    // Encapsulation (private)
    private string $packageName;
    private int $price;
    private array $features = [];

    // Static property
    public static int $count = 0;

    // Class constant
    const COMPANY = "DollieMooi Studio";

    // Constructor
    public function __construct(string $packageName, int $price, array $features) {
        $this->packageName = $packageName;
        $this->setPrice($price); // gunakan setter agar validasi jalan
        $this->features = $features;
        self::$count++;
        $this->log("Paket {$this->packageName} dibuat.");
    }

    // Getter & Setter (encapsulation)
    public function getPackageName(): string {
        return $this->packageName;
    }

    public function setPackageName(string $name) {
        $this->packageName = $name;
    }

    public function getPrice(): int {
        return $this->price;
    }

    public function setPrice(int $price) {
        if ($price < 0) throw new Exception("Harga tidak boleh negatif!");
        $this->price = $price;
    }

    public function getFeatures(): array {
        return $this->features;
    }

    public function setFeatures(array $features) {
        $this->features = $features;
    }

    // Magic Methods
    public function __toString(): string {
        return "Paket: {$this->packageName} (Rp {$this->price})";
    }

    public function __destruct() {
        $this->log("Paket {$this->packageName} dihapus.");
    }
}

class PhotoboxController {
    private array $packages = [];

    // Create
    public function addPackage(Photobox $pb) {
        $this->packages[] = $pb;
    }

    // Read
    public function showPackages(): array {
        return $this->packages;
    }

    // Update
    public function updatePackage(string $name, int $newPrice) {
        foreach ($this->packages as $pkg) {
            if ($pkg->getPackageName() === $name) {
                $pkg->setPrice($newPrice);
                echo "Harga paket {$name} berhasil diupdate ke Rp {$newPrice}.\n";
                return; // Keluar setelah update (asumsi hanya satu paket dengan nama sama)
            }
        }
        echo "Paket '{$name}' tidak ditemukan untuk diupdate.\n";
    }

    // Delete
    public function deletePackage(string $name) {
        foreach ($this->packages as $i => $pkg) {
            if ($pkg->getPackageName() === $name) {
                unset($this->packages[$i]);
                echo "Paket {$name} berhasil dihapus.\n";
                $this->packages = array_values($this->packages); // reindex
                return; // Keluar setelah delete
            }
        }
        echo "Paket '{$name}' tidak ditemukan untuk dihapus.\n";
    }

    // Polymorphism: display info
    public function display() {
        if (empty($this->packages)) {
            echo "Tidak ada paket tersisa.\n";
            return;
        }
        foreach ($this->packages as $pkg) {
            echo $pkg . "\n";
            echo "  Fitur: " . implode(", ", $pkg->getFeatures()) . "\n";
        }
    }
}

try {
    // Buat Controller
    $controller = new PhotoboxController();

    // Tambah beberapa paket photobox
    $p1 = new Photobox("Basic", 500000, ["20 Foto", "Softcopy"]);
    $p2 = new Photobox("Premium", 1000000, ["50 Foto", "Album", "Cetak"]);
    $p3 = new Photobox("Wedding Special", 2500000, ["Unlimited Foto", "Album Eksklusif", "Video Booth"]);

    $controller->addPackage($p1);
    $controller->addPackage($p2);
    $controller->addPackage($p3);

    // Tampilkan header
    echo str_repeat("=", 50) . "\n";
    echo "Welcome to " . APP_NAME . " 🎉\n";
    echo str_repeat("=", 50) . "\n\n";

    // READ
    echo "DAFTAR PAKET PHOTOBOX:\n";
    echo str_repeat("-", 30) . "\n";
    foreach ($controller->showPackages() as $pkg) {
        echo "Nama Paket: " . $pkg->getPackageName() . "\n";
        echo "  Harga: Rp " . number_format($pkg->getPrice(), 0, ',', '.') . "\n";
        echo "  Fitur: " . implode(", ", $pkg->getFeatures()) . "\n";
        echo "\n";
    }

    // UPDATE
    echo str_repeat("=", 50) . "\n";
    echo "UPDATE HARGA:\n";
    echo str_repeat("-", 30) . "\n";
    $controller->updatePackage("Premium", 1200000);

    // DELETE
    echo str_repeat("=", 50) . "\n";
    echo "HAPUS PAKET:\n";
    echo str_repeat("-", 30) . "\n";
    $controller->deletePackage("Basic");

    // READ lagi setelah update & delete
    echo str_repeat("=", 50) . "\n";
    echo "DAFTAR PAKET SETELAH UPDATE & DELETE:\n";
    echo str_repeat("-", 30) . "\n";
    $controller->display();

    // Footer
    echo str_repeat("=", 50) . "\n";
    echo "© " . date("Y") . " " . Photobox::COMPANY . " | v" . VERSION . "\n";

} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
    echo "Trace: " . $e->getTraceAsString() . "\n"; // Tambahan untuk debug lebih baik
}
?>
