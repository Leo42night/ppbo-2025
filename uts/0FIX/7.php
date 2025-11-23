<?php
// ==========================
// Class Kamar
// ==========================
class Kamar {
    private $nomorKamar;
    private $tipeKamar;
    private $harga; // Encapsulation

    public function __construct($nomorKamar, $tipeKamar, $harga) {
        $this->nomorKamar = $nomorKamar;
        $this->tipeKamar = $tipeKamar;
        $this->harga = $harga;
    }

    // Getter
    public function getNomorKamar() {
        return $this->nomorKamar;
    }

    public function getTipeKamar() {
        return $this->tipeKamar;
    }

    public function getHarga() {
        return $this->harga;
    }

    // Polymorphism: menghitung harga sesuai tipe kamar
    public function getHargaFinal() {
        switch (strtolower($this->tipeKamar)) {
            case 'deluxe':
                return $this->harga * 1.2; // +20%
            case 'suite':
                return $this->harga * 1.5; // +50%
            default:
                return $this->harga;
        }
    }
}

// ==========================
// Class Tamu
// ==========================
class Tamu {
    public $nama;
    public $idTamu;

    public function __construct($nama, $idTamu) {
        $this->nama = $nama;
        $this->idTamu = $idTamu;
    }
}

// ==========================
// Class Reservasi (Composition)
// ==========================
class Reservasi {
    private $tamu;   // HAS-A relationship (composition)
    private $kamar;  // HAS-A relationship (composition)
    private $malam;

    private static $jumlahReservasi = 0; // Static counter

    public function __construct(Tamu $tamu, Kamar $kamar, $malam) {
        $this->tamu = $tamu;
        $this->kamar = $kamar;
        $this->malam = $malam;
        self::$jumlahReservasi++; // naik setiap kali buat reservasi baru
    }

    public function hitungTotalBiaya() {
        return $this->kamar->getHargaFinal() * $this->malam;
    }

    public function tampilkanInfo() {
        $total = $this->hitungTotalBiaya();
        echo "Tamu: {$this->tamu->nama} (ID: {$this->tamu->idTamu})<br>";
        echo "Kamar: {$this->kamar->getNomorKamar()} - {$this->kamar->getTipeKamar()}<br>";
        echo "Jumlah Malam: {$this->malam}<br>";
        echo "Total Biaya: Rp " . number_format($total, 0, ',', '.') . "<br><br>";
    }

    public static function getJumlahReservasi() {
        return self::$jumlahReservasi;
    }
}

// ==========================
// MAIN PROGRAM
// ==========================
$tamu1 = new Tamu("Budi", "T001");
$kamar1 = new Kamar("101", "Deluxe", 500000);
$reservasi1 = new Reservasi($tamu1, $kamar1, 3);

$tamu2 = new Tamu("Sari", "T002");
$kamar2 = new Kamar("202", "Suite", 800000);
$reservasi2 = new Reservasi($tamu2, $kamar2, 2);

$reservasi1->tampilkanInfo();
$reservasi2->tampilkanInfo();

echo "Jumlah Reservasi: " . Reservasi::getJumlahReservasi();
