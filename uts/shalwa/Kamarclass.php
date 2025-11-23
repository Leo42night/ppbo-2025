<?php
 class Kamar {
     public $nomorKamar;
     public $tipeKamar;
     private $harga; // enkapsulasi
 
     public function __construct($nomorKamar, $tipeKamar, $harga) {
         $this->nomorKamar = $nomorKamar;
         $this->tipeKamar = $tipeKamar;
         $this->harga = $harga;
     }
 
     public function getHarga() {
         return $this->harga;
     }
 }
 
 class Tamu {
     public $nama;
     public $idTamu;
 
     public function __construct($nama, $idTamu) {
         $this->nama = $nama;
         $this->idTamu = $idTamu;
     }
 }
 
 class Reservasi {
     private $tamu;
     private $kamar;
     public static $totalReservasi = 0;
 
     public function __construct(Tamu $tamu, Kamar $kamar) {
         $this->tamu = $tamu;
         $this->kamar = $kamar;
         self::$totalReservasi++;
    }
 
     public function hitungTotalBiaya($malam) {
         $hargaDasar = $this->kamar->getHarga();
         $tipe = strtolower($this->kamar->tipeKamar);
         $faktor = 1.0;
         if ($tipe === 'deluxe') {
             $faktor = 1.966666;
         } elseif ($tipe === 'suite') {
             $faktor = 2.0;
         }
         $total = $hargaDasar * $faktor * $malam;
         return $total;
     }
 
     public function cetakRincian($malam) {
         echo "Tamu: {$this->tamu->nama} (ID: {$this->tamu->idTamu})\n";
         echo "Kamar: {$this->kamar->nomorKamar} - {$this->kamar->tipeKamar}\n";
         echo "Jumlah Malam: {$malam}\n";
         echo "Total Biaya: Rp " . number_format($this->hitungTotalBiaya($malam), 0, ',', '.') . "\n\n";
     }
 
     public static function getTotalReservasi() {
         return self::$totalReservasi;
     }
 }
 
 // Contoh
 $kamar1 = new Kamar(101, "Deluxe", 200000);
 $tamu1 = new Tamu("Budi", "T001");
 $res1 = new Reservasi($tamu1, $kamar1);
 $res1->cetakRincian(3);
 
 $kamar2 = new Kamar(202, "Suite", 600000);
 $tamu2 = new Tamu("Sari", "T002");
 $res2 = new Reservasi($tamu2, $kamar2);
 $res2->cetakRincian(2);
 
 // Jumlah reservasi
 // echo "Total reservasi: " . Reservasi::getTotalReservasi() . "\n";
 ?>