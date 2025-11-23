<?php
class Film {
    public $judul;
    public $kategori;
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

    public function __construct($film, $umurPenonton) {
        $this->film = $film;
        $this->umurPenonton = $umurPenonton;
    }

    public function hitungHarga() {
        $harga = $this->film->hargaDasar;

        if ($this->film->kategori == "Premium") {
            $harga *= 1.5;
        }

        if ($this->umurPenonton < 12) {
            $harga *= 0.7;
        } elseif ($this->umurPenonton >= 60) {
            $harga *= 0.8;
        }

        return $harga;
    }

    public function cetakTiket() {
        echo "Film: {$this->film->judul} ({$this->film->kategori})\n";
        echo "Umur Penonton: {$this->umurPenonton}\n";
        echo "Harga Tiket: Rp " . number_format($this->hitungHarga(), 0, ',', '.') . "\n\n";
    }
}

$film1 = new Film("Avengers", "Reguler", 50000);
$tiket1 = new Tiket($film1, 10);
$tiket1->cetakTiket();

$tiket2 = new Tiket($film1, 30);
$tiket2->cetakTiket();

$film2 = new Film("Avatar 2", "Premium", 70000);
$tiket3 = new Tiket($film2, 65);
$tiket3->cetakTiket();

$tiket4 = new Tiket($film2, 25);
$tiket4->cetakTiket();
?>