<?php

class Matematika {
    const PI = 3.14;
    

    private static $counter = 0;

    public static function hitungLuasLingkaran($r) {
        self::$counter++;
        
        return self::PI * $r * $r;
    }

    public static function getCounter() {
        return self::$counter;
    }
}

// MAIN PROGRAM
// Panggil method static langsung dari class tanpa membuat objek
echo "Luas lingkaran (r=7): " . Matematika::hitungLuasLingkaran(7) . "\n";
echo "Luas lingkaran (r=10): " . Matematika::hitungLuasLingkaran(10) . "\n";

// Menampilkan berapa kali method dipanggil
echo "Method hitungLuasLingkaran dipanggil sebanyak: " . Matematika::getCounter() . " kali\n";

?>
