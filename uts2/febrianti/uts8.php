<?php

class Film {
    public $judul;
    public $kategori; // Reguler, Premium
    public $hargaDasar;

    public function __construct($judul, $kategori, $hargaDasar) {
        $this->judul = $judul;
        $this->kategori = $kategori;
        $this->hargaDasar = $hargaDasar;
    }
}

class Tiket {
    private $film;
    private $umurPenonton;

    public function __construct(Film $film, $umurPenonton) {
        $this->film = $film;
        $this->umurPenonton = $umurPenonton;
    }

    public function hitungHarga() {
        $harga = $this->film->hargaDasar;

        // Aturan 1: Kategori film
        if ($this->film->kategori === 'Premium') {
            $harga *= 1.50; // Harga dasar + 50%
        }

        // Aturan 2: Diskon umur
        if ($this->umurPenonton < 12) {
            $harga *= 0.70; // Diskon 30%
        } elseif ($this->umurPenonton >= 60) {
            $harga *= 0.80; // Diskon 20%
        }

        return $harga;
    }

    public function cetakTiket() {
        echo "Film: {$this->film->judul} ({$this->film->kategori})\n";
        echo "Umur Penonton: {$this->umurPenonton}\n";
        echo "Harga Tiket: Rp " . number_format($this->hitungHarga(), 0, ',', '.') . "\n\n";
    }
}

// MAIN PROGRAM
// Membuat objek film
$filmReguler = new Film("Avengers", "Reguler", 50000);
$filmPremium = new Film("Avatar 2", "Premium", 70000);

// Skenario 1: Film Reguler, Anak-anak
$tiket1 = new Tiket($filmReguler, 10);
$tiket1->cetakTiket();

// Skenario 2: Film Reguler, Dewasa
$tiket2 = new Tiket($filmReguler, 30);
$tiket2->cetakTiket();

// Skenario 3: Film Premium, Lansia
$tiket3 = new Tiket($filmPremium, 65);
$tiket3->cetakTiket();

// Skenario 4: Film Premium, Dewasa
$tiket4 = new Tiket($filmPremium, 25);
$tiket4->cetakTiket();

?>