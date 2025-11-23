<?php
class Matematika {
    const VI = '3.14';
    static $counter = 0;

    // Method untuk menghitung luas lingkaran
    public static function hitungLuasLingkaran($r) {
        self::$counter++;
        return self::VI*$r*$r;
    }

    // Method untuk menampilkan berapa kali method dipanggil
    public static function getCounter() {
        return self::$counter;
    }
}


// MAIN PROGRAM


// Panggil method hitungLuasLingkaran beberapa kali tanpa membuat objek
echo "Luas lingkaran (r=7): " . Matematika::hitungLuasLingkaran(7) . "\n";
echo "Luas lingkaran (r=10): " . Matematika::hitungLuasLingkaran(10) . "\n";


// Tampilkan berapa kali method sudah dipanggil
echo "Method hitungLuasLingkaran dipanggil sebanyak: " . Matematika::getCounter() . " kali\n";

?>
