<?php

class Matematika {
    // TODO: buat konstanta PI dengan nilai 3.14
    const PI = 3.14;
    
    // TODO: buat atribut static $counter untuk menghitung berapa kali method hitungLuasLingkaran dipanggil
    private static $counter = 0;

    // Method untuk menghitung luas lingkaran
    public static function hitungLuasLingkaran($r) {
        // TODO: tambahkan counter setiap kali method dipanggil
        // TODO: gunakan konstanta PI untuk menghitung luas lingkaran
        self::$counter++;
        return self::PI * $r * $r;
    }

    // Method untuk menampilkan berapa kali method dipanggil
    public static function getCounter() {
        // TODO: kembalikan nilai $counter
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