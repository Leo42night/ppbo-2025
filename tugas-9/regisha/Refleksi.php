<?php
// 17. Reflection
require 'autoload.php';

use PerpustakaanOOP\Model\Buku;
use PerpustakaanOOP\Model\BukuFiksi; // Tambahkan use statement ini!

echo "<h2>17. Reflection</h2>";

function reflectClass($classToCheck) {
    $reflectionClass = new \ReflectionClass($classToCheck);

    echo "<h3>Menganalisis Class: " . $reflectionClass->getName() . " ---</h3>";
    echo "Nama Class: " . $reflectionClass->getName() . "<br>";
    echo "Apakah Final? " . ($reflectionClass->isFinal() ? 'Ya' : 'Tidak') . "<br>"; // Poin penting!

    echo "<h4>Constants:</h4>";
    // ... (kode getConstants, getProperties, getMethods Anda di sini) ...
    // hilangkan detailnya agar lebih ringkas
    echo "<h4>Methods:</h4>";
    foreach ($reflectionClass->getMethods() as $method) {
        echo "Method: " . $method->getName() . "<br>";
    }
}

// 1. Uji Class yang TIDAK Final (Buku)
reflectClass(Buku::class);

// 2. Uji Class yang YA Final (BukuFiksi)
reflectClass(BukuFiksi::class);
?>