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
        if ($this->film->kategori == 'Premium') {
            $harga *= 1.50; 
        }
        if ($this->umurPenonton < 12) {
            $harga *= 0.70; 
        } elseif ($this->umurPenonton >= 60) {
            $harga *= 0.80; 
        }
        return $harga;
    }
    public function tampilkanDetail() {
        echo "Film: " . $this->film->judul . " (" . $this->film->kategori . ")\n";
        echo "Umur Penonton: " . $this->umurPenonton . "\n";
        echo "Harga Tiket: Rp " . number_format($this->hitungHarga(), 0, ',', '.') . "\n\n";
    }
}

$filmReguler = new Film('Avengers', 'Reguler', 50000);
$filmPremium = new Film('Avatar 2', 'Premium', 70000);

$tiket1 = new Tiket($filmReguler, 10);
$tiket2 = new Tiket($filmReguler, 30);
$tiket3 = new Tiket($filmPremium, 65);
$tiket4 = new Tiket($filmPremium, 25);

$tiket1->tampilkanDetail();
$tiket2->tampilkanDetail();
$tiket3->tampilkanDetail();
$tiket4->tampilkanDetail();

?>