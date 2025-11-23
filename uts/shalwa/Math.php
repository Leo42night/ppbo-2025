<?php
 class Matematika {
     const PI = 3.14;
     private static $counter = 0;
 
     public static function hitungLuasLingkaran($r) {
         self::$counter++;
         $luas = self::PI * $r * $r;
         // Jika ingin hasil sesuai contoh tanpa desimal berlebih, format angka sesuai kebutuhan
         return $luas;
     }
 
     public static function getCounter() {
         return self::$counter;
     }
 }
 
 // MAIN PROGRAM
 echo "Luas lingkaran (r=7): " . Matematika::hitungLuasLingkaran(7) . "\n";
 echo "Luas lingkaran (r=10): " . Matematika::hitungLuasLingkaran(10) . "\n";
 echo "Method hitungLuasLingkaran dipanggil sebanyak: " . Matematika::getCounter() . " kali\n";
 ?>