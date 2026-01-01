<?php
// Kelas Film
class Film {
    public $judul;
    public $kategori; // Reguler atau Premium
    public $hargaDasar;

    public function __construct($judul, $kategori, $hargaDasar) {
        $this->judul = $judul;
        $this->kategori = $kategori;
        $this->hargaDasar = $hargaDasar;
    }
}
// Kelas Tiket
class Tiket {
    private $film;
    private $umurPenonton;

    public function __construct(Film $film, $umurPenonton) {
        $this->film = $film;
        $this->umurPenonton = $umurPenonton;
    }

    // Hitung harga tiket sesuai aturan
    public function hitungHarga() {
        $harga = $this->film->hargaDasar;

        // Aturan kategori film
        if (strtolower($this->film->kategori) === 'premium') {
            $harga *= 1.5; // +50%
        }

        // Diskon berdasarkan umur
        if ($this->umurPenonton < 12) {
            $harga *= 0.7; // diskon 30%
        } elseif ($this->umurPenonton >= 60) {
            $harga *= 0.8; // diskon 20%
        }

        return $harga;
    }

    // Cetak info tiket
    public function cetakTiket() {
        echo "Film: {$this->film->judul} ({$this->film->kategori})\n";
        echo "Umur Penonton: {$this->umurPenonton}\n";
        echo "Harga Tiket: Rp " . number_format($this->hitungHarga(), 0, ',', '.') . "\n\n";
    }
}

// MAIN PROGRAM
// Contoh film
$film1 = new Film("Avengers", "Reguler", 50000);
$film2 = new Film("Avatar 2", "Premium", 70000);

// Contoh pemesanan tiket
$tiket1 = new Tiket($film1, 10); // diskon 30%
$tiket2 = new Tiket($film1, 30); // normal
$tiket3 = new Tiket($film2, 65); // premium + diskon 20%
$tiket4 = new Tiket($film2, 25); // premium, normal

// Cetak semua tiket
$tiket1->cetakTiket();
$tiket2->cetakTiket();
$tiket3->cetakTiket();
$tiket4->cetakTiket();
?>