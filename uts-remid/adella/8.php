<?php
class Film {
    private $judul;
    private $kategori; 
    private $hargaDasar;

    public function __construct($judul, $kategori, $hargaDasar) {
        $this->judul = $judul;
        $this->kategori = $kategori;
        $this->hargaDasar = $hargaDasar;
    }

    public function getJudul() {
        return $this->judul;
    }

    public function getKategori() {
        return $this->kategori;
    }

    public function getHargaDasar() {
        return $this->hargaDasar;
    }
}

class Tiket {
    private $film;
    private $umurPenonton;

    public function __construct($film, $umurPenonton) {
        if ($umurPenonton < 0) {
            throw new Exception("Umur tidak boleh negatif!");
        }
        $this->film = $film;
        $this->umurPenonton = $umurPenonton;
    }

    public function getFilm() { 
        return $this->film;
    }

    public function hitungHarga() {
        $hargaDasar = $this->film->getHargaDasar();
        $kategori = $this->film->getKategori();
        $umur = $this->umurPenonton;

        $hargaSementara = $hargaDasar;
        if ($kategori === "Premium") {
            $hargaSementara *= 1.5;
        }

        $diskon = 0;
        if ($umur < 12) {
            $diskon = 0.3;
        } elseif ($umur >= 60) {
            $diskon = 0.2;
        }

        $hargaFinal = $hargaSementara * (1 - $diskon);
        return round($hargaFinal);
    }

    public function getUmurPenonton() {
        return $this->umurPenonton;
    }
}

function cetakTiket($tiket) {
    $film = $tiket->getFilm(); 
    $harga = $tiket->hitungHarga();
    echo "Film: " . $film->getJudul() . " (" . $film->getKategori() . ")\n";
    echo "Umur Penonton: " . $tiket->getUmurPenonton() . "\n";
    echo "Harga Tiket: Rp " . number_format($harga, 0, ',', '.') . "\n\n";
}

$film1 = new Film("Avengers", "Reguler", 50000);
$tiket1 = new Tiket($film1, 10);
cetakTiket($tiket1);

$tiket2 = new Tiket($film1, 30);
cetakTiket($tiket2);

$film2 = new Film("Avatar 2", "Premium", 70000);
$tiket3 = new Tiket($film2, 65);
cetakTiket($tiket3);

$tiket4 = new Tiket($film2, 25);
cetakTiket($tiket4);
?>