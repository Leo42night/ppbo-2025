<?php
class Matematika {
    const PI = 3.14;
    private static $counter = 0;
    public static function hitungLuasLingkaran($r){
        if ($r <= 0) {
            echo "Jari-jari tidak boleh nol/negatif";
            return 0;
        }
    self::$counter++;
    $luas = self::PI * $r * $r;
        echo "Luas lingkaran (r=$r) adalah: $luas\n";
        return $luas;
    }
    public static function getCounter() {
        return self::$counter;
    }   
}

Matematika::hitungLuasLingkaran(7);
Matematika::hitungLuasLingkaran(10);
echo "Method hitungLuasLingkaran dipanggil sebanyak: " . Matematika::getCounter(). " kali\n";
?>