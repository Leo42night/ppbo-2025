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
    public function getHarga() { return $this->harga; }
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
        self::$totalReservasi++;
    }

    public function hitungTotalBiaya($malam) {
        $hargaDasar = $this->kamar->getHarga();
        $biayaAkhir = $hargaDasar;
        if ($this->kamar->tipeKamar === 'Deluxe') {
            $biayaAkhir *= 1.20;
        } elseif ($this->kamar->tipeKamar === 'Suite') {
            $biayaAkhir *= 1.50;
        }
        return $biayaAkhir * $malam;
    }

    public function tampilkanDetail($malam) {
        echo "Tamu: {$this->tamu->nama} (ID: {$this->tamu->idTamu})\n";
        echo "Kamar: {$this->kamar->nomorKamar} - {$this->kamar->tipeKamar}\n";
        echo "Jumlah Malam: {$malam}\n";
        echo "Total Biaya: Rp " . number_format($this->hitungTotalBiaya($malam), 0, ',', '.') . "\n\n";
    }
}

$kamar1 = new Kamar(101, 'Deluxe', 500000);
$kamar2 = new Kamar(202, 'Suite', 800000);
$tamu1 = new Tamu('Budi', 'T001');
$tamu2 = new Tamu('Sari', 'T002');

$reservasi1 = new Reservasi($tamu1, $kamar1);
$reservasi1->tampilkanDetail(3);
$reservasi2 = new Reservasi($tamu2, $kamar2);
$reservasi2->tampilkanDetail(2);
?>