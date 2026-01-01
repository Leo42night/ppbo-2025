<?php

abstract class Kendaraan{
    abstract public function jalan();
}

class mobil extends Kendaraan{
    public function jalan(){
        return "Mobil sedang berjalan di jalan raya";
    }
}

class motor extends Kendaraan {
    public function jalan(){
        return "Motor berjalan di jalan raya";
    }
}

$kendaraan1 = new mobil();
$kendaraan2 = new motor();

echo "=== OUTPUT HASIL ===\n";
echo "1. " . $kendaraan1 -> jalan() . "\n";
echo "2. " . $kendaraan2 -> jalan(). "\n";


?>
