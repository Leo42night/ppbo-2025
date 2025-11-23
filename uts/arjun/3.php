<?php
class kendaraan {
    public function jalan() {
        echo" mobil bisa berjalan";
    }
}


class Mobil {
    public function jalan() {
        return "Mobil sedang berjalan di jalan raya";
    }
}

class Motor {
    public function jalan() {
        return "Motor juga sedang berjalan di jalan raya";
    }
}

$kendaraan1 = new Mobil();
$kendaraan2 = new Motor();

echo "=== OUTPUT HASIL ===\n";
echo "1. " .$kendaraan1->jalan(), "\n";
echo "2. " .$kendaraan2->jalan(), "\n";
?>

