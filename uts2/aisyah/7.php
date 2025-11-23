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
    private $tamu;
    private $kamar;
    private $malam;

    private static $jumlahReservasi = 0; 

    public function __construct(Tamu $tamu, Kamar $kamar, $malam) {
        $this->tamu = $tamu;
        $this->kamar = $kamar;
        $this->malam = $malam;
        self::$jumlahReservasi++; 
    }

    public function hitungTotalBiaya() {
        $hargaDasar = $this->kamar->getHarga();
        $tipe = strtolower($this->kamar->tipeKamar);

        if ($tipe === "deluxe") {
            $hargaDasar *= 1.2; // +20%
        } elseif ($tipe === "suite") {
            $hargaDasar *= 1.5; // +50%
        }

        return $hargaDasar * $this->malam;
    }

    public static function getJumlahReservasi() {
        return self::$jumlahReservasi;
    }

    public function tampilkanInfo() {
        echo "Tamu: {$this->tamu->nama} (ID: {$this->tamu->idTamu})\n";
        echo "Kamar: {$this->kamar->nomorKamar} - {$this->kamar->tipeKamar}\n";
        echo "Jumlah Malam: {$this->malam}\n";
        echo "Total Biaya: Rp " . number_format($this->hitungTotalBiaya(), 0, ',', '.') . "\n\n";
    }
}

$tamu1 = new Tamu("Budi", "T001");
$kamar1 = new Kamar(101, "Deluxe", 500000);
$reservasi1 = new Reservasi($tamu1, $kamar1, 3);

$tamu2 = new Tamu("Sari", "T002");
$kamar2 = new Kamar(202, "Suite", 800000);
$reservasi2 = new Reservasi($tamu2, $kamar2, 2);

$reservasi1->tampilkanInfo();
$reservasi2->tampilkanInfo();

echo "Total reservasi yang dibuat: " . Reservasi::getJumlahReservasi() . "\n";
?>