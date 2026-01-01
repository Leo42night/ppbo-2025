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

// Contoh penggunaan
$d1 = new Film('Avengers:End Game', 'Premium', 100000);
$t1 = new Tiket($d1, 19);
echo $t1->cetak();

$d2 = new Film('Avengers:Secret War', 'Reguler', 75000);
$t2 = new Tiket($d2, 40);
echo $t2->cetak();

$d3 = new Film('Avengers:Infinity War', 'Premium', 100000);
$t3 = new Tiket($d3, 30);
echo $t3->cetak();

$d4 = new Film('Avengers:Age Of Ultron', 'Premium', 100000);
$t4 = new Tiket($d4, 21);
echo $t4->cetak();
?>


