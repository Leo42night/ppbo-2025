<?php

// Kelas dasar Kamar dengan encapsulation untuk harga
class Kamar {
    protected $nomorKamar;
    protected $tipeKamar;
    private $harga;

    public function __construct($nomorKamar, $tipeKamar, $harga) {
        $this->nomorKamar = $nomorKamar;
        $this->tipeKamar = $tipeKamar;
        $this->harga = $harga;
    }

    // Getter untuk harga (encapsulation)
    public function getHarga() {
        return $this->harga;
    }

    // Getter untuk nomorKamar dan tipeKamar
    public function getNomorKamar() {
        return $this->nomorKamar;
    }

    public function getTipeKamar() {
        return $this->tipeKamar;
    }

    // Method yang akan di-override untuk polymorphism (biaya per malam dasar)
    public function hitungBiayaPerMalam() {
        return $this->harga;
    }
}

// Subclass Deluxe: Tambahan biaya 20%
class Deluxe extends Kamar {
    public function hitungBiayaPerMalam() {
        return $this->getHarga() * 1.20;
    }
}

// Subclass Suite: Tambahan biaya 50%
class Suite extends Kamar {
    public function hitungBiayaPerMalam() {
        return $this->getHarga() * 1.50;
    }
}

// Kelas Tamu
class Tamu {
    private $nama;
    private $idTamu;

    public function __construct($nama, $idTamu) {
        $this->nama = $nama;
        $this->idTamu = $idTamu;
    }

    // Getter
    public function getNama() {
        return $this->nama;
    }

    public function getIdTamu() {
        return $this->idTamu;
    }
}

// Kelas Reservasi dengan composition (memiliki Tamu dan Kamar)
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

    // Method untuk menghitung total biaya (menggunakan polymorphism dari Kamar)
    public function hitungTotalBiaya() {
        $biayaPerMalam = $this->kamar->hitungBiayaPerMalam();
        return $biayaPerMalam * $this->malam;
    }

    // Getter
    public function getTamu() {
        return $this->tamu;
    }

    public function getKamar() {
        return $this->kamar;
    }

    public function getMalam() {
        return $this->malam;
    }

    // Method static untuk menghitung jumlah total reservasi
    public static function getTotalReservasi() {
        return self::$totalReservasi;
    }
}

// MAIN PROGRAM
// Buat tamu dan reservasi pertama (Deluxe, harga dasar 500000 → +20% = 600000/malam)
$tamu1 = new Tamu("Budi", "T001");
$kamar1 = new Deluxe(101, "Deluxe", 500000);
$reservasi1 = new Reservasi($tamu1, $kamar1, 3);

// Buat tamu dan reservasi kedua (Suite, harga dasar 800000 → +50% = 1200000/malam)
$tamu2 = new Tamu("Sari", "T002");
$kamar2 = new Suite(202, "Suite", 800000);
$reservasi2 = new Reservasi($tamu2, $kamar2, 2);

// Output sesuai contoh
echo "Tamu: " . $reservasi1->getTamu()->getNama() . " (ID: " . $reservasi1->getTamu()->getIdTamu() . ")\n";
echo "Kamar: " . $reservasi1->getKamar()->getNomorKamar() . " - " . $reservasi1->getKamar()->getTipeKamar() . "\n";
echo "Jumlah Malam: " . $reservasi1->getMalam() . "\n";
echo "Total Biaya: Rp " . number_format($reservasi1->hitungTotalBiaya(), 0, ',', '.') . "\n\n";

echo "Tamu: " . $reservasi2->getTamu()->getNama() . " (ID: " . $reservasi2->getTamu()->getIdTamu() . ")\n";
echo "Kamar: " . $reservasi2->getKamar()->getNomorKamar() . " - " . $reservasi2->getKamar()->getTipeKamar() . "\n";
echo "Jumlah Malam: " . $reservasi2->getMalam() . "\n";
echo "Total Biaya: Rp " . number_format($reservasi2->hitungTotalBiaya(), 0, ',', '.') . "\n";

// Opsional: Tampilkan total reservasi (sesuai instruksi, meski tidak di contoh output)
echo "\nTotal reservasi yang dibuat: " . Reservasi::getTotalReservasi() . "\n";
?>