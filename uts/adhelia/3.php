<?php
abstract class Kendaraan {
    abstract public function jalan();
}

class Mobil extends Kendaraan {
    public function jalan() {
        return "Mobil sedang berjalan di jalan raya";
    }
}
class Motor extends Kendaraan {
    public function jalan() {
        return "Motor berjalan di jalan raya";
    }
}

$kendaraan1 = new Mobil();
$kendaraan2 = new Motor();

function mulai_jalan($objek_kendaraan){
return $objek_kendaraan->jalan();
}
echo "=== OUTPUT HASIL ===\n";
echo mulai_jalan($kendaraan1). "\n";
echo mulai_jalan($kendaraan2);
?>
