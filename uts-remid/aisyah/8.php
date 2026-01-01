<?php
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

class Tiket {
    public $film;
    public $umurPenonton;

    public function __construct(Film $film, $umurPenonton) {
        $this->film = $film;
        $this->umurPenonton = $umurPenonton;
    }

    public function hitungHarga() {
        $harga = $this->film->hargaDasar;

        if (strtolower($this->film->kategori) === "premium") {
            $harga *= 1.5;
        }

        if ($this->umurPenonton < 12) {
            $harga *= 0.7; // diskon 30%
        } elseif ($this->umurPenonton >= 60) {
            $harga *= 0.8; // diskon 20%
        }

        return $harga;
    }

    public function tampilkanInfo() {
        echo "Film: {$this->film->judul} ({$this->film->kategori})\n";
        echo "Umur Penonton: {$this->umurPenonton}\n";
        echo "Harga Tiket: Rp " . number_format($this->hitungHarga(), 0, ',', '.') . "\n\n";
    }
}

$film1 = new Film("Avengers", "Reguler", 50000);
$film2 = new Film("Avatar 2", "Premium", 70000);

$tiket1 = new Tiket($film1, 10);
$tiket2 = new Tiket($film1, 30);
$tiket3 = new Tiket($film2, 65);
$tiket4 = new Tiket($film2, 25);

$tiket1->tampilkanInfo();
$tiket2->tampilkanInfo();
$tiket3->tampilkanInfo();
$tiket4->tampilkanInfo();
?>