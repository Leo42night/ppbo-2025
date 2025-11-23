<?php


class Kamar {
    public $nomorKamar;
    public $tipeKamar; 
    private $harga;

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
    private $jumlahMalam;
    private static $totalReservasi = 0;

    public function __construct(Tamu $tamu, Kamar $kamar, $jumlahMalam) {
        $this->tamu = $tamu;
        $this->kamar = $kamar;
        $this->jumlahMalam = $jumlahMalam;
        self::$totalReservasi++;
    }

    public function hitungTotalBiaya() {
        $hargaDasar = $this->kamar->getHarga() * $this->jumlahMalam;
        $totalBiaya = $hargaDasar;

      
        switch ($this->kamar->tipeKamar) {
            case 'Deluxe':
                $totalBiaya *= 1.20; 
                break;
            case 'Suite':
                $totalBiaya *= 1.50; 
                break;
        }
        return $totalBiaya;
    }

    public function tampilkanDetail() {
        echo "Tamu: " . $this->tamu->nama . " (ID: " . $this->tamu->idTamu . ")\n";
        echo "Kamar: " . $this->kamar->nomorKamar . " - " . $this->kamar->tipeKamar . "\n";
        echo "Jumlah Malam: " . $this->jumlahMalam . "\n";
        echo "Total Biaya: Rp " . number_format($this->hitungTotalBiaya(), 0, ',', '.') . "\n\n";
    }
    
    public static function getTotalReservasi() {
        return self::$totalReservasi;
    }
}


$kamar1 = new Kamar(101, 'Deluxe', 500000);
$kamar2 = new Kamar(202, 'Suite', 800000);

$tamu1 = new Tamu('Budi', 'T001');
$tamu2 = new Tamu('Sari', 'T002');

$reservasi1 = new Reservasi($tamu1, $kamar1, 3);
$reservasi2 = new Reservasi($tamu2, $kamar2, 2);

$reservasi1->tampilkanDetail();
$reservasi2->tampilkanDetail();



?>