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
    public function __construct(Film $film, $umurPenonton) {
        $this->film = $film;
        $this->umurPenonton = $umurPenonton;
    }

    public function hitungHarga() {
        $harga = $this->film->hargaDasar;

        if ($this->film->kategori == 'Premium') {
            $harga *= 1.5;
        }

        if ($this->umurPenonton < 12) {
            $harga *= 0.7;
        } elseif ($this->umurPenonton >= 60) {
            $harga *= 0.8;
        }
        return $harga;
    }
}

$filmReguler = new Film("Avengers", "Reguler", 50000);
$filmPremium = new Film("Avatar 2", "Premium", 70000);

$tiket1 = new Tiket($filmReguler, 10);
echo "Film: Avengers (Reguler)\n";
echo "Umur Penonton: 10\n";
echo "Harga Tiket : Rp " . number_format($tiket1->hitungHarga()) . "\n";

$tiket2 = new Tiket($filmReguler, 30);
echo "Film: Avengers (Premium)\n";
echo "Umur Penonton: 30\n";
echo "Harga Tiket : Rp " . number_format($tiket2->hitungHarga()) . "\n";

$tiket3 = new Tiket($filmPremium, 65);
echo "Film: Avatar 2 (Premium)\n";
echo "Umur Penonton: 65\n";
echo "Harga Tiket : Rp " . number_format($tiket3->hitungHarga()) . "\n";

$tiket4 = new Tiket($filmPremium, 25);
echo "Film: Avatar 2 (Premium)\n";
echo "Umur Penonton: 25\n";
echo "Harga Tiket : Rp " . number_format($tiket4->hitungHarga()) . "\n";
?>