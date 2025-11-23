<?php
class Kendaraan {
    public $motor;
    public $mobil;

}
 public function jalan() {
         echo "Kendaraan sedang berjalan”;
    }

class Mobil {
    public function jalan() {
        return "Mobil sedang berjalan di jalan raya";
    }
}


class Motor {
    public function jalan() {
        return "Motor berjalan di jalan raya";
    }
}

$kendaraan1 = new Mobil();
$kendaraan2 = new Motor();

echo "=== OUTPUT HASIL ===\n";
echo "1. " . $kendaraan1->јаƖаη() . "\n";
echo "2. " . $kendaraan2->јаƖаη() . "\n";
?>
