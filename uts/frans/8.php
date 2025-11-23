<?php
class Film {
    public $judul;
    public $kategori;
    public $hargaDasar;
}

class Tiket {
    public $film;
    public $umurPenonton;

    public function hitungHarga($kategori, $hargaDasar, $umurPenonton) {
        if $kategori = "Premium":
            $hargaDasar + 50%;
        elseif $umurPenonton < 12:
            $hargaDasar - 30%;
        elseif $umurPenonton >= 60

    }
}