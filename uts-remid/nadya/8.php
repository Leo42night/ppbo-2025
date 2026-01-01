
<?php

class Film {
    public $judul;
    public $kategori;
    public $hargadasar;

    public function __construct($judul, $kategori, $hargadasar){
        $this->judul = $judul;
        $this->kategori = $kategori;
        $this->hargadasar = $hargadasar;
    }
}

class Tiket {
    private $film;
    private $umurPenonton;
    

    public function __construct(Film $film, $umurPenonton) {
        $this->film = $film;
        $this->umurPenonton = $umurPenonton;
    }

    public function hitungHarga(){
        $harga = $this->film->hargadasar;
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

    public function cetak(){
        $output  = "Film: {$this->film->judul} ({$this->film->kategori}) \n";
        $output .= "Umur Penonton: {$this->umurPenonton} \n";
        $output .= "Harga Tiket: Rp " . number_format($this->hitungHarga(), 0, ',', '.') . "\n \n";
        return $output;
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
