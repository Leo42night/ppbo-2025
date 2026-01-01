<?php

class Kamar {
    public $nomorKamar;
    public $tipeKamar; // Deluxe, Suite
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
    
    // Atribut statis untuk menghitung total reservasi
    private static $jumlahReservasi = 0;

    public function __construct(Tamu $tamu, Kamar $kamar) {
        $this->tamu = $tamu;
        $this->kamar = $kamar;
        // Increment counter setiap kali objek Reservasi dibuat
        self::$jumlahReservasi++;
    }

    public function hitungTotalBiaya($malam) {
        $hargaDasar = $this->kamar->getHarga();
        $totalBiaya = $hargaDasar;

        // Terapkan polymorphism berdasarkan tipe kamar
        switch ($this->kamar->tipeKamar) {
            case 'Deluxe':
                $totalBiaya *= 1.20; // Tambahan biaya 20%
                break;
            case 'Suite':
                $totalBiaya *= 1.50; // Tambahan biaya 50%
                break;
        }

        return $totalBiaya * $malam;
    }

    public function tampilkanDetail($malam) {
        echo "Tamu: {$this->tamu->nama} (ID: {$this->tamu->idTamu})\n";
        echo "Kamar: {$this->kamar->nomorKamar} - {$this->kamar->tipeKamar}\n";
        echo "Jumlah Malam: {$malam}\n";
        echo "Total Biaya: Rp " . number_format($this->hitungTotalBiaya($malam), 0, ',', '.') . "\n\n";
    }
    
    // Method static untuk mendapatkan jumlah total reservasi
    public static function getTotalReservasi() {
        return self::$jumlahReservasi;
    }
}

// MAIN PROGRAM
// Harga dasar kamar
$hargaDeluxe = 500000;
$hargaSuite = 800000;

// Membuat objek tamu dan kamar
$tamu1 = new Tamu("Budi", "T001");
$kamar1 = new Kamar(101, "Deluxe", $hargaDeluxe);
$reservasi1 = new Reservasi($tamu1, $kamar1);
$reservasi1->tampilkanDetail(3);


$tamu2 = new Tamu("Sari", "T002");
$kamar2 = new Kamar(202, "Suite", $hargaSuite);
$reservasi2 = new Reservasi($tamu2, $kamar2);
$reservasi2->tampilkanDetail(2);

echo "Jumlah total reservasi yang dibuat: " . Reservasi::getTotalReservasi() . "\n";

?>