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

    public function __construct(Film $film, $umurPenonton) {
        $this->film = $film;
        $this->umurPenonton = $umurPenonton;
    }

    public function hitungHarga() {
        $harga = $this->film->hargaDasar;
        $diskon = 0;

        if (strtolower($this->film->kategori) === 'premium') {
            $harga *= 1.50; 
        }

        if ($this->umurPenonton < 12) {
            $diskon = 0.30;
        } elseif ($this->umurPenonton >= 60) {
            $diskon = 0.20;
        }
        
        if ($diskon > 0) {
            $harga = $harga * (1 - $diskon);
        }

        return round($harga);
    }

    public function cetakTiket() {
        $hargaFinal = $this->hitungHarga();
        $hargaFormat = number_format($hargaFinal, 0, ',', '.');
        
        $output = "Film: " . $this->film->judul . " (" . $this->film->kategori . ")\n";
        $output .= "Umur Penonton: " . $this->umurPenonton . "\n";
        $output .= "Harga Tiket: Rp " . $hargaFormat . "\n";

        return $output;
    }
}

$filmAvengers = new Film("Avengers", "Reguler", 50000);
$filmAvatar2 = new Film("Avatar 2", "Premium", 70000);

$tiket1 = new Tiket($filmAvengers, 10);
$tiket2 = new Tiket($filmAvengers, 30);
$tiket3 = new Tiket($filmAvatar2, 65);
$tiket4 = new Tiket($filmAvatar2, 25);


echo $tiket1->cetakTiket() . "\n";
echo $tiket2->cetakTiket() . "\n";
echo $tiket3->cetakTiket() . "\n";
echo $tiket4->cetakTiket() . "\n";