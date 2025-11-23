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
    public $film;
    public $umurPenonton;

    public function __construct($film, $umurPenonton) {
        $this->film = $film;
        $this->umurPenonton = $umurPenonton;
    }

    public function hitungHarga() {
        if (strtolower($this->film->kategori) == "premium") {
            $harga = $this->film->hargaDasar * 1.5;
        } else {
            $harga = $this->film->hargaDasar;
        }

        if ($this->umurPenonton < 12) {
            $harga *= 0.7; 
        } elseif ($this->umurPenonton >= 60) {
            $harga *= 0.8;
        }

        return $harga;
    }

    public function cetakTiket() {
        $hargaFinal = $this->hitungHarga();
        echo "Film: {$this->film->judul} ({$this->film->kategori})\n";
        echo "Umur Penonton: {$this->umurPenonton}\n";
        echo "Harga Tiket: Rp " . number_format($hargaFinal, 0, ',', '.') . "\n";
    }
}

$film1 = new Film("Avengers", "Reguler", 50000);
$film2 = new Film("Avatar 2", "Premium", 70000);

$tiket1 = new Tiket($film1, 10);
$tiket2 = new Tiket($film1, 30);
$tiket3 = new Tiket($film2, 65);
$tiket4 = new Tiket($film2, 25);

$tiket1->cetakTiket();
$tiket2->cetakTiket();
$tiket3->cetakTiket();
$tiket4->cetakTiket();
?>
