<?php
class Kamar{
    public $nomorKamar;
    public $tipeKamar;
    protected $harga;
}
class Tamu{
    public $nama;
    public $idTamu;
}
class Reservasi extends Kamar{
    public $nomorKamar;
    public $nama;
    public $harga;
    public $persen;
    public $hasil;
    static $counter = 0;
    public function hitungTotalBiaya($malam){
        self::$counter + 1;
        echo "\nJumlah malam: $malam\n";
        if ($this->tipeKamar == "Suite"){
            $this->persen = $this->harga * 0.2;
            $this->hasil = $this->harga + $this->persen;
        }
        elseif ($this->tipeKamar == "Deluxe"){
            $this->persen = $this->harga * 0.5;
            $this->hasil = $this->harga + $this->persen;

        }
        return $this->hasil * $malam . "\n\n";
    }

}
$reservasi=new Reservasi();
$reservasi->nama="Budi (ID: T001)\n";
$reservasi->nomorKamar="101 - ";
$reservasi->harga=1000000;
$reservasi->tipeKamar="Suite";
echo "Tamu: ".$reservasi->nama;
echo "Kamar: ".$reservasi->nomorKamar;
echo $reservasi->tipeKamar;
echo "Total Biaya: ".$reservasi->hitungTotalBiaya(3);

$rsrvsi=new Reservasi();
$rsrvsi->nama="Sari (ID: T002)\n";
$rsrvsi->nomorKamar="202 - ";
$rsrvsi->harga=2000000;
$rsrvsi->tipeKamar="Deluxe";
echo "Tamu: ".$rsrvsi->nama;
echo "Kamar: ".$rsrvsi->nomorKamar;
echo $rsrvsi->tipeKamar;
echo "Total Biaya: ".$rsrvsi->hitungTotalBiaya(2);
?>