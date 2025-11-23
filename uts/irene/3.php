<?php
abstract class Kendaraan{

    abstract public function jalan();
}


class Mobil extends Kendaraan{
    public function jalan() {
    echo "Mobil sedang berjalan di jalan raya";
    echo "\n";
    }
}

class Motor extends Kendaraan {
    public function jalan() {
        echo "Motor berjalan di jalan raya";
        echo "\n";
    }
}


$kendaraan1 = new Mobil();
$kendaraan2 = new Motor();

echo "=== OUTPUT HASIL ===\n";
echo $kendaraan1->jalan();
echo "\n";
echo $kendaraan2->jalan();
?>

