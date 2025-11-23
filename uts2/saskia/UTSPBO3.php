<?php

abstract class kendaraan{
    abstract public function jalan();

}
class mobil extends kendaraan {
    public function jalan() {
        return "mobil sedang di jalan raya";
    }
}
class motor extends kendaraan {
    public function jalan() {
        return "motor sedang di jalan raya";
    }
}
$kendaraan1 = new Mobil();
$kendaraan2 = new Motor();

echo "=== OUTPUT HASIL ===\n";
echo "1. " . $kendaraan1->jalan() . "\n";
echo "2. " . $kendaraan2->jalan() . "\n";
?>
