<?php

class Kamar {
    public $nomorKamar;
    public $tipeKamar;
    private $hargaDasar;

    public function __construct($nomorKamar, $tipeKamar, $hargaDasar) {
        $this->nomorKamar = $nomorKamar;
        $this->tipeKamar = $tipeKamar;
        $this->hargaDasar = $hargaDasar;
    }

    public function getHargaDasar() {
        return $this->hargaDasar;
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
    private static $totalReservasi = 0; 

    public function __construct(Tamu $tamu, Kamar $kamar) {
        $this->tamu = $tamu;
        $this->kamar = $kamar;
        self::tambahReservasi(); 
    }

    private static function tambahReservasi() {
        self::$totalReservasi++;
    }

    public static function getTotalReservasi() {
        return self::$totalReservasi;
    }

    public function hitungTotalBiaya($malam) {
        $hargaDasar = $this->kamar->getHargaDasar();
        $tipeKamar = strtolower($this->kamar->tipeKamar);
        $biayaTambahan = 0;

        switch ($tipeKamar) {
            case 'deluxe':
                $biayaTambahan = 0.20; 
                break;
            case 'suite':
                $biayaTambahan = 0.50; 
                break;
            default:
                $biayaTambahan = 0;
        }

        $hargaFinalPerMalam = $hargaDasar * (1 + $biayaTambahan);
        $totalBiaya = $hargaFinalPerMalam * $malam;

        return $totalBiaya;
    }

    public function tampilkanDetailReservasi($malam) {
        $totalBiaya = $this->hitungTotalBiaya($malam);
        
        $output = "Tamu: " . $this->tamu->nama . " (ID: " . $this->tamu->idTamu . ")\n";
        $output .= "Kamar: " . $this->kamar->nomorKamar . " -" . $this->kamar->tipeKamar . "\n";
        $output .= "Jumlah Malam: " . $malam . "\n";
        $output .= "Total Biaya: Rp " . number_format($totalBiaya, 0, ',', '.') . "\n";
        
        return $output;
    }
}

$kamarDeluxe = new Kamar("101", "Deluxe", 500000);
$kamarSuite = new Kamar("202", "Suite", 800000);

$tamuBudi = new Tamu("Budi", "T001");
$tamuSari = new Tamu("Sari", "T002");

$reservasi1 = new Reservasi($tamuBudi, $kamarDeluxe);
$malam1 = 3;

$reservasi2 = new Reservasi($tamuSari, $kamarSuite);
$malam2 = 2;

echo $reservasi1->tampilkanDetailReservasi($malam1) . "\n";
echo $reservasi2->tampilkanDetailReservasi($malam2) . "\n";

echo "Total Reservasi yang dibuat: " . Reservasi::getTotalReservasi() . "\n";