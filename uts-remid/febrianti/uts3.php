<?php
abstract class Kendaraan{
    abstract public function jalan();
}
class Mobil extends Kendaraan {
    public function jalan() {
        return "Mobil sedang berjalan di jalan raya ";
    }
}
class Motor extends Kendaraan {
    public function jalan() {
        return "Motor berjalan di jalan raya ";
    }
}
$kendaraan1 = new Mobil();
$kendaraan2 = new Motor();
echo "=== OUTPUT HASIL ===\n";
echo $kendaraan1->jalan();
echo "\n";
echo $kendaraan2->jalan();