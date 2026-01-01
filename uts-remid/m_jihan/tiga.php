<?php
abstract class Kendaraan {
    abstract public function jalan();
}

class Mobil extends Kendaraan {
    public function jalan() {
        return "Mobil berjalan dijalan raya";
    }
}

class Motor extends Kendaraan {
    public function jalan() {
        return "Motor berjalan dijalan raya";
    }
}

$kendaraan1 = new Mobil();
$kendaraan2 = new Motor();

echo "=== OUTPUT HASIL ===\n";
echo "1. " . $kendaraan1->jalan() . "\n";
echo "2. " . $kendaraan2->jalan() . "\n";
?>