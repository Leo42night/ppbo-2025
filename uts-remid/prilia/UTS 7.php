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

    public function setHarga($harga) {
        $this->harga = $harga;
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
    private $malam;
    private static $totalReservasi = 0;

    public function __construct(Tamu $tamu, Kamar $kamar, $malam) {
        $this->tamu = $tamu;
        $this->kamar = $kamar;
        $this->malam = $malam;
        self::$totalReservasi++;
    }

    public function hitungTotalBiaya() {
        $hargaPerMalam = $this->kamar->getHarga();
        if ($this->kamar->tipeKamar == "Deluxe") {
            $hargaPerMalam *= 1.2;
        } elseif ($this->kamar->tipeKamar == "Suite") {
            $hargaPerMalam *= 1.5;
        }
        return $hargaPerMalam * $this->malam;
    }

    public function tampilkanReservasi() {
        echo "Tamu: {$this->tamu->nama} (ID: {$this->tamu->idTamu})\n";
        echo "Kamar: {$this->kamar->nomorKamar} - {$this->kamar->tipeKamar}\n";
        echo "Jumlah Malam: {$this->malam}\n";
        echo "Total Biaya: Rp " . number_format($this->hitungTotalBiaya(), 0, ',', '.') . "\n\n";
    }

    public static function getTotalReservasi() {
        return self::$totalReservasi;
    }
}

$tamu1 = new Tamu("Budi", "T001");
$kamar1 = new Kamar(101, "Deluxe", 500000);
$reservasi1 = new Reservasi($tamu1, $kamar1, 3);
$reservasi1->tampilkanReservasi();

$tamu2 = new Tamu("Sari", "T002");
$kamar2 = new Kamar(202, "Suite", 800000);
$reservasi2 = new Reservasi($tamu2, $kamar2, 2);
$reservasi2->tampilkanReservasi();

echo "Total Reservasi: " . Reservasi::getTotalReservasi();
