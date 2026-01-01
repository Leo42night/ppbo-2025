<?php

class Kamar {
    protected $nomorKamar;  
    protected $tipeKamar;
    private $harga;  

    public function __construct($nomorKamar, $tipeKamar, $harga) {
        $this->nomorKamar = $nomorKamar;
        $this->tipeKamar = $tipeKamar;
        $this->harga = $harga;
    }

    protected function getHargaBase() {
        return $this->harga;
    }

    public function getHargaEfektif() {
        return $this->getHargaBase();  
    }

    public function tampilkanInfo() {
        return $this->nomorKamar . " - " . $this->tipeKamar;
    }
}

class Deluxe extends Kamar {
    public function __construct($nomorKamar, $harga) {
        parent::__construct($nomorKamar, "Deluxe", $harga);  
    }

    public function getHargaEfektif() {
        return $this->getHargaBase() * 1.2;  
    }
}

class Suite extends Kamar {
    public function __construct($nomorKamar, $harga) {
        parent::__construct($nomorKamar, "Suite", $harga); 
    }

    public function getHargaEfektif() {
        return $this->getHargaBase() * 1.5;  
    }
}

class Tamu {
    private $nama;
    private $idTamu;

    public function __construct($nama, $idTamu) {
        $this->nama = $nama;
        $this->idTamu = $idTamu;
    }

    public function getNama() {
        return $this->nama;
    }

    public function getIdTamu() {
        return $this->idTamu;
    }

    public function tampilkanInfo() {
        return $this->nama . " (ID: " . $this->idTamu . ")";
    }
}

class Reservasi {
    private $tamu;      
    private $kamar;     
    private $malam;
    private static $totalReservasi = 0;  

    public function __construct(Tamu $tamu, Kamar $kamar, $malam) {
        $this->tamu = $tamu;
        $this->kamar = $kamar;
        $this->malam = $malam;
        self::$totalReservasi++;  
    }

    public function hitungTotalBiaya() {
        $hargaEfektif = $this->kamar->getHargaEfektif();
        return $hargaEfektif * $this->malam;
    }

    public function tampilkanReservasi() {
        $totalBiaya = $this->hitungTotalBiaya();
        $biayaFormat = number_format($totalBiaya, 0, ',', '.');

        echo "Tamu: " . $this->tamu->tampilkanInfo() . "\n";
        echo "Kamar: " . $this->kamar->tampilkanInfo() . "\n";
        echo "Jumlah Malam: " . $this->malam . "\n";
        echo "Total Biaya: Rp " . $biayaFormat . "\n\n";
    }

    public static function getJumlahReservasi() {
        return self::$totalReservasi;
    }
}

$tamu1 = new Tamu("Budi", "T001");
$tamu2 = new Tamu("Sari", "T002");

$kamar1 = new Deluxe("101", 500000);  
$kamar2 = new Suite("202", 800000);   

$reservasi1 = new Reservasi($tamu1, $kamar1, 3);
$reservasi2 = new Reservasi($tamu2, $kamar2, 2);

$reservasi1->tampilkanReservasi();
$reservasi2->tampilkanReservasi();

echo "Total reservasi yang dibuat: " . Reservasi::getJumlahReservasi() . "\n";

?>

