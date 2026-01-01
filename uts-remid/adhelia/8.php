<?php
class Film{
    private $judul;
    private $kategori;
    private $harga;

    public function __construct($judul, $kategori, $harga){
        $this->judul = $judul;
        $this->kategori = $kategori;
        $this->harga = $harga;
    }

    public function getJudul() { return $this->judul; }
    public function getKategori() { return $this->kategori; }
    public function getHargaDasar() { return $this->harga; }
}

class Tiket{
    private $film;
    private $umurPenonton;

    public function __construct($film, $umurPenonton) {
        $this->film = $film;
        $this->umurPenonton = $umurPenonton;
    }

    public function hitungHarga() {
        $harga = $this->film->getHargaDasar();

        // Aturan kategori Premium
        if ($this->film->getKategori() == "Premium") {
            $harga *= 1.5;
        }

        // Aturan diskon umur
        if ($this->umurPenonton < 12) {
            $harga *= 0.7; // diskon 30%
        } elseif ($this->umurPenonton >= 60) {
            $harga *= 0.8; // diskon 20%
        }

        return $harga;
    }

    public function cetakTiket() {
        echo "Film: " . $this->film->getJudul() . " (" . $this->film->getKategori() . ")\n";
        echo "Umur Penonton: " . $this->umurPenonton . "\n";
        echo "Harga Tiket: Rp " . number_format($this->hitungHarga(), 0, ',', '.') . "\n\n";
    }
}

// === MAIN PROGRAM ===
$film1 = new Film("Avengers", "Reguler", 50000);
$film2 = new Film("Avatar 2", "Premium", 70000);

// Contoh pemesanan tiket
$tiket1 = new Tiket($film1, 10);   // umur < 12
$tiket2 = new Tiket($film1, 30);   // umur dewasa
$tiket3 = new Tiket($film2, 65);   // premium + diskon lansia
$tiket4 = new Tiket($film2, 25);   // premium + harga normal

// Cetak hasil
$tiket1->cetakTiket();
$tiket2->cetakTiket();
$tiket3->cetakTiket();
$tiket4->cetakTiket();
?>
