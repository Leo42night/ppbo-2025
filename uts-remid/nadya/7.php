<?php
// Buat kelas Kamar dengan atribut nomorKamar, tipeKamar, dan harga. Gunakan encapsulation untuk atribut harga.

class Kamar {
    public $nomorKamar;
    public $tipeKamar;
    private $harga;

    public function __construct($nomor, $tipe, $harga){
        $this->nomorKamar = $nomor;
        $this->tipeKamar = $tipe;
        $this->harga = $harga; 
    }

    public function getharga(){
        return $this->harga;
    }
}

class Tamu {
    public $nama;
    public $idTamu;

    public function __construct($nama, $idTamu){
        $this->nama = $nama;
        $this->idTamu = $idTamu;
    }
}

class Reservasi {
    private $tamu;
    private $kamar;
    private static $totalReservasi = 0;

    public function __construct(Tamu $tamu, Kamar $kamar){
        $this->tamu = $tamu;
        $this->kamar = $kamar;
        self::$totalReservasi++;
    }

    public function hitungTotalBiaya($malam){
        $hargaDasar = $this->kamar->getharga();
        $tipe = strtolower($this->kamar->tipeKamar);
        $multiplier = 1;
        if ($tipe === 'deluxe'){
            $multiplier = 1.2;
        } elseif ($tipe === 'suite') {
            $multiplier = 1.5;
        }
        $total = $hargaDasar * $multiplier * $malam;
        return $total;
    }

    public static function getTotalReservasi(){
        return self::$totalReservasi;
    }

    public function cetakRincian($malam){
        $out = "Tamu: {$this->tamu->nama} (ID: {$this->tamu->idTamu})\n";
        $out .= "Kamar: {$this->kamar->nomorKamar} - {$this->kamar->tipeKamar}\n";
        $out .= "Jumlah Malam: {$malam}\n";
        $out .= "Total Biaya: Rp " . number_format($this->hitungTotalBiaya($malam), 0, ',', '.') . "\n\n";
        return $out;
    }
}

$kamarA = new Kamar(234, 'deluxe', 340000);
$tamuA = new Tamu('Nadya', 'T001');
$regisA = new Reservasi($tamuA, $kamarA);

$kamarB = new Kamar(320, 'suite', 890000);
$tamuB = new Tamu('Nayla', 'S007');
$regisB = new Reservasi($tamuB, $kamarB);

echo $regisA->cetakRincian(4);
echo $regisB->cetakRincian(2);

?>