<?php
require __DIR__ . "/core/Autoloader.php";

use Models\Bunga;
use Models\Aksesoris;
use Models\toko;
use Models\Pelanggan;

// buat objek
$toko = new toko();
$bunga1 = new Bunga("Mawar", 50000);
$bunga2 = new Bunga("Tulip", 70000);
$vas = new Aksesoris("Vas Cantik", 30000);

// tambahkan ke toko
$toko->tambahProduk($bunga1);
$toko->tambahProduk($bunga2);
$toko->tambahProduk($vas);

// pelanggan
$pelanggan = new Pelanggan("Yasmin");

// tampilkan produk
echo "\nDaftar Produk:\n";
foreach ($toko as $p) {
    echo $p->info() . "\n";
}

echo "Pelanggan: " . $pelanggan->getNama() . "\n";

// Serialization
echo "\nSerialization:\n";
echo serialize($bunga1) . "\n";

// Reflection
echo "\nReflection:\n";
$ref = new \ReflectionClass(Bunga::class);
print_r($ref->getProperties());
