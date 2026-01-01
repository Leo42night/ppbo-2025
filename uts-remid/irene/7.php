<?php
class Tamu {
    private $nama;
    private $idTamu;
    public function __construct($nama, $idTamu) {
        $this->nama = $nama;
        $this->idTamu = $idTamu;
    }
    public function getNama(){
        return $this->nama;
    }
    public function getIdTamu(){
        return $this->idTamu; 
    }
}

class Kamar {
    private $nomorKamar;
    private $tipeKamar;
    private $harga;

    public function __construct($nomorKamar,  $tipeKamar, $harga){
        $this->nomorKamar = $nomorKamar;
        $this->tipeKamar = $tipeKamar;
        $this->harga = $harga;
    }
    public function getNomorKamar(){
        return  $this->nomorKamar;
    }
    public function getTipeKamar(){
        return  $this->tipeKamar;
    }
    public function getHarga(){
        return $this->harga;
    }
}

class Reservasi {
    private $tamu;
    private $kamar;
    private $malam;
    private static $totalReservasi = 0;

    public function __construct($tamu, $kamar, $malam){
        $this->tamu = $tamu;
        $this->kamar = $kamar;
        $this->malam = $malam;
        self::$totalReservasi++;
    }
    public function hitungTotalBiaya(){
        $harga1 = $this->kamar->getHarga();
        $tipe = $this->kamar->getTipeKamar();
        $total = $harga1 * $this->malam;

        if ($tipe == "Deluxe"){
            $total += $total * 0.20;
        }elseif ($tipe == "Suite"){
            $total += $total * 0.50;
        }
        return $total;
    }
    public static function getTotalReservasi(){
        return self::$totalReservasi;
    }
    public function tampilkanInfo(){
        echo "Tamu: {$this->tamu->getNama()} (ID: {$this->tamu->getIdTamu()})";
        echo "\n";
        echo "Kamar: {$this->kamar->getNomorKamar()} - {$this->kamar->getTipeKamar()}";
        echo "\n";
        echo "Jumlah Malam: {$this->malam}";
        echo "\n";
        echo "Total Biaya: Rp. " . number_format($this->hitungTotalBiaya(), 0, ',', '.');
        echo "\n";
    }
}

// ===== MAIN PROGRAM =====
$tamu1 = new Tamu("Budi", "T001");
$kamar1 = new Kamar(101, "Deluxe", 500000);
$reservasi1 = new Reservasi($tamu1, $kamar1, 3);
echo "\n";
$tamu2 = new Tamu("Sari", "T002");
$kamar2 = new Kamar(202, "Suite", 800000);
$reservasi2 = new Reservasi($tamu2, $kamar2, 2);

// Tampilkan hasil reservasi
$reservasi1->tampilkanInfo();
echo "\n";
$reservasi2->tampilkanInfo();

echo "Jumlah total reservasi: " . Reservasi::getTotalReservasi();

?>