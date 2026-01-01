<?php
class Matematika {
    const PI = 3.14;
    private static $counter = 0;

    public static function hitungLuasLingkaran($r) {
        self::$counter++;
        $luas = self::PI * $r * $r;
        
        if (fmod($luas, 1) == 0) {
            return (int)$luas;
        }
        return round($luas, 2);
    }

    public static function getCounter() {
        return self::$counter;
    }
}

echo "Luas lingkaran (r=7): " . Matematika::hitungLuasLingkaran(7) . "\n";
echo "Luas lingkaran (r=10): " . Matematika::hitungLuasLingkaran(10) . "\n";
echo "Method hitungLuasLingkaran dipanggil sebanyak " . Matematika::getCounter() . " kali\n";
?>