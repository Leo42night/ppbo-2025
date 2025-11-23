<?php


class Matematika {
    Const PI = 3.14;// buat konstanta PI dengan nilai 3.14
    private static $counter = 0; // buat atribut static $counter untuk menghitung berapa kali method hitungLuasLingkaran dipanggil


    // Method untuk menghitung luas lingkaran
    public static function hitungLuasLingkaran($r) {
       self::$counter++;
       $luas = self::PI*$r*$r;

       if(fmod($luas, 1) == 0){
        return (int)$luas;
       }
       return round($luas, 2);
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