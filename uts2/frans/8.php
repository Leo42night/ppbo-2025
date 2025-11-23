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
        if (strtolower($this->film->kategori) === 'premium') {
            $harga *= 1.5; 
        }
        if ($this->umurPenonton < 12) {
            $harga *= 0.7; 
        } elseif ($this->umurPenonton >= 60) {
            $harga *= 0.8; 
        }
        return round($harga);
    }

    public function cetak() {
        $hargaFinal = $this->hitungHarga();
        return "Film: {$this->film->judul} ({$this->film->kategori})\nUmur Penonton: {$this->umurPenonton}\nHarga Tiket: Rp " . number_format($hargaFinal, 0, ',', '.') . "\n\n";
    }
}

$f1 = new Film('Avengers', 'Reguler', 50000);
$t1 = new Tiket($f1, 10);
echo $t1->cetak();

$f2 = new Film('Avengers', 'Reguler', 50000);
$t2 = new Tiket($f2, 30);
echo $t2->cetak();

$f3 = new Film('Avatar 2', 'Premium', 140000);
$t3 = new Tiket($f3, 65);
echo $t3->cetak();

$f4 = new Film('Avatar 2', 'Premium', 140000);
$t4 = new Tiket($f4, 25);
echo $t4->cetak();
?>