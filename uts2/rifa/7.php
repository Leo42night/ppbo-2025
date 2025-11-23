<?php
// Kelas Kamar
class Kamar {
    public $nomorKamar;
    public $tipeKamar;
    private $harga; // encapsulation

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
// Kelas Tamu
class Tamu {
    public $nama;
    public $idTamu;

    public function __construct($nama, $idTamu) {
        $this->nama = $nama;
        $this->idTamu = $idTamu;
    }
}
// Kelas Reservasi
class Reservasi {
    private $tamu;       // Tamu
    private $kamar;      // Kamar
    private $jumlahMalam;
    private static $totalReservasi = 0;

    public function __construct(Tamu $tamu, Kamar $kamar, $jumlahMalam) {
        $this->tamu = $tamu;
        $this->kamar = $kamar;
        $this->jumlahMalam = $jumlahMalam;
        self::$totalReservasi++;
    }

    // Hitung total biaya dengan polymorphism berdasarkan tipe kamar
    public function hitungTotalBiaya() {
        $hargaDasar = $this->kamar->getHarga();
        $tipe = strtolower($this->kamar->tipeKamar);

        if ($tipe === "deluxe") {
            $hargaTotal = $hargaDasar * 1.2 * $this->jumlahMalam; // tambah 20%
        } elseif ($tipe === "suite") {
            $hargaTotal = $hargaDasar * 1.5 * $this->jumlahMalam; // tambah 50%
        } else {
            $hargaTotal = $hargaDasar * $this->jumlahMalam; // tipe lain
        }

        return $hargaTotal;
    }

    // Method static untuk jumlah total reservasi
    public static function getTotalReservasi() {
        return self::$totalReservasi;
    }

    // Cetak info reservasi
    public function cetakReservasi() {
        echo "Tamu: {$this->tamu->nama} (ID: {$this->tamu->idTamu})\n";
        echo "Kamar: {$this->kamar->nomorKamar} - {$this->kamar->tipeKamar}\n";
        echo "Jumlah Malam: {$this->jumlahMalam}\n";
        echo "Total Biaya: Rp " . number_format($this->hitungTotalBiaya(), 0, ',', '.') . "\n\n";
    }
}

// MAIN PROGRAM
// Reservasi 1
$tamu1 = new Tamu("Budi", "T001");
$kamar1 = new Kamar(101, "Deluxe", 500000);
$reservasi1 = new Reservasi($tamu1, $kamar1, 3);
$reservasi1->cetakReservasi();

// Reservasi 2
$tamu2 = new Tamu("Sari", "T002");
$kamar2 = new Kamar(202, "Suite", 800000);
$reservasi2 = new Reservasi($tamu2, $kamar2, 2);
$reservasi2->cetakReservasi();

// Total reservasi dibuat
echo "Total reservasi dibuat: " . Reservasi::getTotalReservasi() . " kali\n";
?>