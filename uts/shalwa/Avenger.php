<?php
 class Film {
     public $judul;
     public $kategori; // Reguler atau Premium
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
             $harga *= 1.5; // +50%
         }
         // Diskon berdasarkan umur
         if ($this->umurPenonton < 12) {
             $harga *= 0.7; // diskon 30%
         } elseif ($this->umurPenonton >= 60) {
             $harga *= 0.8; // diskon 20%
         }
         return $harga;
     }
 
     public function cetak() {
         echo "Film: {$this->film->judul} ({$this->film->kategori})\n";
         echo "Umur Penonton: {$this->umurPenonton}\n";
         echo "Harga Tiket: Rp " . number_format($this->hitungHarga(), 0, ',', '.') . "\n\n";
     }
 }
 
 // Contoh pemesanan
 $film1 = new Film("Avengers", "Reguler", 50000);
 $t1 = new Tiket($film1, 10);
 $t1->cetak();
 
 $t2 = new Tiket($film1, 30);
 $t2->cetak();
 
 $film2 = new Film("Avatar 2", "Premium", 70000);
 $t3 = new Tiket($film2, 65);
 $t3->cetak();
 
 $t4 = new Tiket($film2, 25);
 $t4->cetak();
 ?>