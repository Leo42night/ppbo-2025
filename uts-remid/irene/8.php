<?php 
class Film {
    private $judul;
    private $kategori;
    private $hargaDasar;

    public function __construct($judul,  $kategori, $hargaDasar) {
        $this->judul = $judul;
        $this->kategori = $kategori;
        $this->hargaDasar = $hargaDasar;
    }
    public function getJudul(){
        return $this->judul;
    }
    public function getKategori(){
        return $this->kategori;
    }
    public function gethargaDasar(){
        return $this->hargaDasar;
    }
}

class Tiket {
    private $film;
    private $umurPenonton;

    public function __construct($film, $umurPenonton) {
        $this->film = $film;
        $this->umurPenonton = $umurPenonton;
    }
    public function hitungHarga() {
        $harga = $this->film->gethargaDasar();
        $kategori = $this->film->getKategori();

        if ($kategori == "Premium") {
            $harga += $harga * 0.50;
        }
        if ($this->umurPenonton < 12) {
            $harga -= $harga * 0.30;
        }elseif ($this->umurPenonton >= 60) {
            $harga -= $harga * 0.20;
        }
        return $harga;
    }
    public function tampilkanInfo(){
        echo "Film: {$this->film->getJudul()} ({$this->film->getKategori()})";
        echo "\n";
        echo "Umur Penonton: {$this->umurPenonton}";
        echo "\n";
        echo "Harga Tiket: Rp " . number_format($this->hitungHarga(), 0, ',', '.');
        echo "\n";
    }
}

// ===== MAIN PROGRAM =====
$film1 = new Film("Avengers", "Reguler", 50000);
$film2 = new Film("Avatar 2", "Premium", 70000);

$tiket1 = new Tiket($film1, 10);  // <12 tahun → diskon 30%
$tiket2 = new Tiket($film1, 30);  // umur normal
$tiket3 = new Tiket($film2, 65);  // premium + diskon 20%
$tiket4 = new Tiket($film2, 25);  // premium normal

// Cetak hasil
$tiket1->tampilkanInfo();
$tiket2->tampilkanInfo();
$tiket3->tampilkanInfo();
$tiket4->tampilkanInfo();
?>