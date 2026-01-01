<?php
class Kamar {
    private $nomorKamar;
    private $tipeKamar;
    private $harga;

    public function __construct($nomorKamar, $tipeKamar, $harga) {
        $this->nomorKamar = $nomorKamar;
        $this->tipeKamar = $tipeKamar;
        $this->harga = $harga;
    }

    public function getNomorKamar() { return $this->nomorKamar; }
    public function getTipeKamar() { return $this->tipeKamar; }
    public function getHarga() { return $this->harga; }
}

class Tamu {
    private $nama;
    private $idTamu;

    public function __construct($nama, $idTamu) {
        $this->nama = $nama;
        $this->idTamu = $idTamu;
    }

    public function getNama() { return $this->nama; }
    public function getIdTamu() { return $this->idTamu; }
}

class Reservasi {
    private $tamu;
    private $kamar;
    private static $jumlahReservasi = 0;

    public function __construct($tamu, $kamar) {
        $this->tamu = $tamu;
        $this->kamar = $kamar;
        self::$jumlahReservasi++;
    }

    public function hitungTotalBiaya($malam) {
        $harga = $this->kamar->getHarga();
        if ($this->kamar->getTipeKamar() == "Deluxe") {
            $harga *= 1.2;
        } elseif ($this->kamar->getTipeKamar() == "Suite") {
            $harga *= 1.5;
        }
        return $harga * $malam;
    }

    public static function getJumlahReservasi() {
        return self::$jumlahReservasi;
    }

    public function cetakReservasi($malam) {
        echo "Tamu: " . $this->tamu->getNama() . " (ID: " . $this->tamu->getIdTamu() . ")\n";
        echo "Kamar: " . $this->kamar->getNomorKamar() . " - " . $this->kamar->getTipeKamar() . "\n";
        echo "Jumlah Malam: $malam\n";
        echo "Total Biaya: Rp " . number_format($this->hitungTotalBiaya($malam), 0, ',', '.') . "\n\n";
    }
}

$tamu1 = new Tamu("Budi", "T001");
$kamar1 = new Kamar("101", "Deluxe", 500000);
$res1 = new Reservasi($tamu1, $kamar1);
$res1->cetakReservasi(3);

$tamu2 = new Tamu("Sari", "T002");
$kamar2 = new Kamar("202", "Suite", 800000);
$res2 = new Reservasi($tamu2, $kamar2);
$res2->cetakReservasi(2);
?>