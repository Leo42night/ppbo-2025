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

    public function lihatHarga() {
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
    private $kamar;
    private $tamu;
    private static $jumlahReservasi = 0;

    public function __construct(Kamar $kamar, Tamu $tamu) {
        $this->kamar = $kamar;
        $this->tamu = $tamu;
        self::$jumlahReservasi++;
    }

    public function hitungTotalBiaya($malam) {
        $hargaKamar = $this->kamar->lihatHarga();
        return $hargaKamar * $malam;
    }

    public static function getJumlahReservasi() {
        return self::$jumlahReservasi;
    }
}

class Deluxe extends Kamar {
    public function lihatHarga() {
        return parent::lihatHarga() * 1.2;
    }
}

class Suite extends Kamar {
    public function lihatHarga() {
        return parent::lihatHarga() * 1.5;
    }
}

$hargaDeluxe = 500000; 
$hargaSuite = 800000; 
$malam1 = 3;
$malam2 = 2;

$tamuBudi = new Tamu("Budi", "T001");
$tamuSari = new Tamu("Sari", "T002");

$kamarDeluxe = new Deluxe("101", "Deluxe", $hargaDeluxe);
$kamarSuite = new Suite("202", "Suite", $hargaSuite); 

$reservasi1 = new Reservasi($kamarDeluxe, $tamuBudi); // Deluxe, 3 malam
$reservasi2 = new Reservasi($kamarSuite, $tamuSari);   // Suite, 2 malam
$reservasi3 = new Reservasi($kamarDeluxe, $tamuBudi); 

function formatRupiah($angka) {
    return "Rp " . number_format($angka, 0, ',', '.');
}

echo "Tamu: " . $tamuBudi->nama . " (ID: {$tamuBudi->idTamu})\n";
echo "Kamar: " . $kamarDeluxe->nomorKamar . " - {$kamarDeluxe->tipeKamar}\n";
echo "Jumlah malam: " . Reservasi::getJumlahReservasi() . "\n";
echo "Total Biaya: Rp. " . formatRupiah($reservasi1->hitungTotalBiaya(3)) . "\n";
echo "\n";
echo "Tamu: " . $tamuSari->nama . " (ID: {$tamuSari->idTamu})\n";
echo "Kamar: " . $kamarSuite->nomorKamar . " - {$kamarSuite->tipeKamar}\n";
echo "Jumlah malam: " . Reservasi::getJumlahReservasi() . "\n";
echo "Total Biaya: Rp. " . formatRupiah($reservasi2->hitungTotalBiaya(2)) . "\n";