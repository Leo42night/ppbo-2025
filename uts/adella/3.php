<?php
abstract class Kendaraan {
   abstract function jalan();
}

class Mobil extends Kendaraan {
    public function jalan() {
        echo "Mobil sedang berjalan di jalan raya";
    }
}

class Motor extends Kendaraan {
    public function jalan() {
        echo "Motor berjalan di jalan raya";
    }
}

$mobil = new Mobil();
$motor = new Motor();
echo "1. " . $mobil->jalan() . "\n";
echo "2 " . $motor->jalan() ."\n";