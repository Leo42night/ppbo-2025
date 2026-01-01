<?php
class Matematika {
    const pi = "3.14";
    static $counter = 0;
    // TODO: buat konstanta PI dengan nilai 3.14
    // TODO: buat atribut static $counter untuk menghitung berapa kali method hitungLuasLingkaran dipanggil


    // Method untuk menghitung luas lingkaran
    public static function hitungLuasLingkaran($r) {
        self::$counter ++;
        return $r * $r * self::pi;
        // TODO: tambahkan counter setiap kali method dipanggil
        // TODO: gunakan konstanta PI untuk menghitung luas lingkaran
    }


    // Method untuk menampilkan berapa kali method dipanggil
    public static function getCounter() {
        return self::$counter;
        // TODO: kembalikan nilai $counter
    }
}


// MAIN PROGRAM


// Panggil method hitungLuasLingkaran beberapa kali tanpa membuat objek
echo "Luas lingkaran (r=7): " . Matematika::hitungLuasLingkaran(7) . "\n";
echo "Luas lingkaran (r=10): " . Matematika::hitungLuasLingkaran(10) . "\n";


// Tampilkan berapa kali method sudah dipanggil
echo "Method hitungLuasLingkaran dipanggil sebanyak: " . Matematika::getCounter() . " kali\n";
?>