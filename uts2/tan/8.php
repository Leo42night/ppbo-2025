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

    public function tampilkanInfo() {
        return $this->judul . " (" . $this->kategori . ")";
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
        $harga = $this->film->getHargaDasar();

        if ($this->film->getKategori() === 'Premium') {
            $harga *= 1.5;  // +50%
        }

        if ($this->umurPenonton < 12) {
            $harga *= 0.7;  // Diskon 30% (bayar 70%)
        } elseif ($this->umurPenonton >= 60) {
            $harga *= 0.8;  // Diskon 20% (bayar 80%)
        }
        
        return $harga;
    }

    public function tampilkanInfo() {
        $harga = $this->hitungHarga();
        $hargaFormat = number_format($harga, 0, ',', '.');

        echo "Film: " . $this->film->tampilkanInfo() . "\n";
        echo "Umur Penonton: " . $this->umurPenonton . "\n";
        echo "Harga Tiket: Rp " . $hargaFormat . "\n\n";
    }
}

$film1 = new Film("Avengers", "Reguler", 50000);  
$film2 = new Film("Avatar 2", "Premium", 70000);  

$tiket1 = new Tiket($film1, 10);  
$tiket1->tampilkanInfo();

$tiket2 = new Tiket($film1, 30);  
$tiket2->tampilkanInfo();

$tiket3 = new Tiket($film2, 65);  

$tiket4 = new Tiket($film2, 25);  
$tiket4->tampilkanInfo();

?>
