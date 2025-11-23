<?php

class Kamar{
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
    public $Idtamu;

    public function __construct($nama, $Idtamu) {
        $this->nama = $nama;
        $this->Idtamu = $Idtamu;
    }
}

class Reservasi {
    public $tamu;
    public $kamar;
    public static $jumlahReservasi = 0;

    public function __construct(Tamu $tamu, Kamar $kamar) {
        $this->tamu = $tamu;
        $this->kamar = $kamar;
        self::$jumlahReservasi++;
    }

    public function hitungTotalBiaya($malam) {
        $hargaAwal = $this->kamar->getHarga();
        $totalBiaya = $hargaAwal;

        if ($this->kamar->tipeKamar == 'Deluxe') {
            $totalBiaya *= 1.20;
        } elseif ($this->kamar->tipeKamar == 'Suite') {
            $totalBiaya *= 1.50;
        }
        return $totalBiaya * $malam;
    }
}
$kamar1 = new Kamar(101, 'Deluxe', 500000);
$tamu1 = new Tamu('Budi', 'T001');
$reservasi1 = new Reservasi($tamu1, $kamar1);

$kamar2 = new Kamar(202, 'Suite', 800000);
$tamu2 = new Tamu('Sari', 'T002');
$reservasi2 = new Reservasi($tamu2, $kamar2);

echo "TamuTotal Biaya Budi: Rp " . number_format($reservasi1->hitungTotalBiaya(3)) . "\n";
echo "Total Biaya Sari: Rp " . number_format($reservasi2->hitungTotalBiaya(2)) . "\n";
echo "Total Reservasi Dibuat: " . Reservasi::$jumlahReservasi . " kali.";
?>