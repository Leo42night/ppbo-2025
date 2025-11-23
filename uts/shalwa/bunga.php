<?php
class Bunga {
    public $nama;
    public $warna;
    public $stok;

    // Constructor: dijalankan saat objek dibuat
    public function __construct(string $nama = "Tanaman", string $warna = "Putih", int $stok = 0) {
        $this->nama = $nama;
        $this->warna = $warna;
        $this->stok = $stok;
        echo "Constructor: Objek Bunga '{$this->nama}' dibuat. Warna: {$this->warna}. Stok: {$this->stok}.\n";
    }

    public function tampilkanInfo() {
        echo "Info Bunga -> Nama: {$this->nama}, Warna: {$this->warna}, Stok: {$this->stok}.\n";
    }

    // Destructor: dijalankan saat objek dihancurkan atau skrip selesai
    public function __destruct() {
        echo "Destructor: Objek Bunga '{$this->nama}' dihancurkan atau skrip selesai.\n";
    }
}

// Contoh penggunaan
$bunga1 = new Bunga("Pinkrose", "Pink", 10);
$bunga1->tampilkanInfo();

// Membuat objek lain
$bunga2 = new Bunga("Lily", "putih", 5);
$bunga2->tampilkanInfo();

// Meng-unset satu objek untuk melihat pemanggilan destructor
unset($bunga1);

echo "Baris akhir skrip.\n";
?>
