<?php
class Kamar {
    public $nomorKamar;
    public $tipeKamar;
    private $harga; 

    public function __construct($nomor, $tipe, $harga) {
        $this->nomorKamar = $nomor;
        $this->tipeKamar = $tipe;
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
    private static $totalReservasi = 0;

    public function __construct(Tamu $tamu, Kamar $kamar) {
        $this->tamu = $tamu;
        $this->kamar = $kamar;
        self::$totalReservasi++;
    }

    public function hitungTotalBiaya($malam) {
        $hargaDasar = $this->kamar->getHarga();
        $tipe = strtolower($this->kamar->tipeKamar);
        $multiplier = 1;
        if ($tipe === 'deluxe') {
            $multiplier = 1.2;
        } elseif ($tipe === 'suite') {
            $multiplier = 1.5;
        }
        $total = $hargaDasar * $multiplier * $malam;
        return $total;
    }

    public static function getTotalReservasi() {
        return self::$totalReservasi;
    }

    public function cetakRincian($malam) {
        $out = "Tamu: {$this->tamu->nama} (ID: {$this->tamu->idTamu})\n";
        $out .= "Kamar: {$this->kamar->nomorKamar} - {$this->kamar->tipeKamar}\n";
        $out .= "Jumlah Malam: {$malam}\n";
        $out .= "Total Biaya: Rp " . number_format($this->hitungTotalBiaya($malam), 0, ',', '.') . "\n\n";
        return $out;
    }
}

$kamar1 = new Kamar(101, 'Deluxe', 200000);
$tamu1 = new Tamu('Budi', 'T001');
$res1 = new Reservasi($tamu1, $kamar1);

$kamar2 = new Kamar(202, 'Suite', 800000);
$tamu2 = new Tamu('Sari', 'T002');
$res2 = new Reservasi($tamu2, $kamar2);

echo $res1->cetakRincian(3);
echo $res2->cetakRincian(2);
?>