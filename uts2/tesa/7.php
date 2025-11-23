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
    private static $totalReservasi = 0;
    private $tamu;
    private $kamar;
    private $malam;

    public function __construct(Tamu $tamu, Kamar $kamar, $malam) {
        $this->tamu = $tamu;
        $this->kamar = $kamar;
        $this->malam = $malam;
        self::$totalReservasi++;
    }

    public function hitungTotalBiaya() {
        $harga = $this->kamar->getHarga();
        if ($this->kamar->tipeKamar == "Deluxe") $harga *= 1.2;
        if ($this->kamar->tipeKamar == "Suite") $harga *= 1.5;
        return $harga * $this->malam;
    }

    public static function getTotalReservasi() {
        return self::$totalReservasi;
    }

    public function cetak() {
        echo "Tamu: {$this->tamu->nama} (ID: {$this->tamu->idTamu})\n";
        echo "Kamar: {$this->kamar->nomorKamar} - {$this->kamar->tipeKamar}\n";
        echo "Jumlah Malam: {$this->malam}\n";
        echo "Total Biaya: Rp " . number_format($this->hitungTotalBiaya(), 0, ',', '.') . "\n\n";
    }
}

// Contoh penggunaan
$tamu1 = new Tamu("Budi", "T001");
$kamar1 = new Kamar(101, "Deluxe", 500000);
$reservasi1 = new Reservasi($tamu1, $kamar1, 3);
$reservasi1->cetak();

$tamu2 = new Tamu("Sari", "T002");
$kamar2 = new Kamar(202, "Suite", 800000);
$reservasi2 = new Reservasi($tamu2, $kamar2, 2);
$reservasi2->cetak();
?>
