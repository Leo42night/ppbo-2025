<?php
class Matematika {
    const PI = 3.14;
    public static $counter = 0;

    public static function hitungLuasLingkaran($r) {
        self::$counter++;
        return self::PI * $r * $r;
    }
    
    public static function getCounter() {
        return self::$counter;
    }
}

echo "Luas lingkaran (r=7): " . Matematika::hitungLuasLingkaran(7) . "\n";
echo "Luas lingkaran (r=10): " . Matematika::hitungLuasLingkaran(10) . "\n";

echo "Method hitungLuasLingkaran dipanggil sebanyak: " . Matematika::getCounter() . " kali\n";