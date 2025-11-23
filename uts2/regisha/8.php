<?php

class Film {
    public $judul;
    public $kategori;
    public $hargaDasar;
}

class Tiket {
    public $film;
    public $umurPenonton;

    public function hitungHarga() {
        $harga = $this->film->hargaDasar;

        if ($this->film->kategori == "Premium") {
            $harga += $harga * 0.5;
        }


        if ($this->umurPenonton < 12) {
            $harga -= $harga * 0.3;
        } elseif ($this->umurPenonton >= 60) {
            $harga -= $harga * 0.2;
        }

        return $harga;
    }

    public function cetakTiket() {
        echo "Film: {$this->film->judul} ({$this->film->kategori})\n";
        echo "Umur Penonton: {$this->umurPenonton}\n";
        echo "Harga Tiket: Rp " . number_format($this->hitungHarga(), 0, ',', '.') . "\n\n";
    }
}

// ==== bikin objek manual ====
$film1 = new Film();
$film1->judul = "Avengers";
$film1->kategori = "Reguler";
$film1->hargaDasar = 50000;

$film2 = new Film();
$film2->judul = "Avatar 2";
$film2->kategori = "Premium";
$film2->hargaDasar = 70000;

$tiket1 = new Tiket();
$tiket1->film = $film1;
$tiket1->umurPenonton = 10;

$tiket2 = new Tiket();
$tiket2->film = $film1;
$tiket2->umurPenonton = 30;

$tiket3 = new Tiket();
$tiket3->film = $film2;
$tiket3->umurPenonton = 65;

$tiket4 = new Tiket();
$tiket4->film = $film2;
$tiket4->umurPenonton = 25;

$tiket1->cetakTiket();
$tiket2->cetakTiket();
$tiket3->cetakTiket();
$tiket4->cetakTiket();
