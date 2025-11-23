<?php

// Autoloader standar PSR-4 (tanpa strtolower)
spl_autoload_register(function ($class) {
    $file = __DIR__ . '/' . str_replace('\\', '/', $class) . '.php';
    if (file_exists($file)) {
        require $file;
    }
});

use App\Models\{Bakmie, SideDish, Pesanan};
use App\Controllers\Kasir;
use App\Services\Pencatat;

echo "<h1>Selamat Datang di Bakmie Nuosa</h1>";
echo "<hr>";

// Dependency Injection
$pencatat = new Pencatat();
$kasir = new Kasir($pencatat);

// --- Membuat item menu berdasarkan gambar ---
// Bakmie
$bakmieOG = new Bakmie("Nuosa OG", 18000, "Ayam Kecap");
$bakmieCharsiu = new Bakmie("Nuosa Charsiu", 23000, "Ayam Charsiu");
$bakmieMalaSpesial = new Bakmie("Mala Spesial", 27000, "Topping Komplit Pedas");

// Side Dishes
$pangsitGoreng = new SideDish("Pangsit Ayam Goreng", 9000, "Pangsit Goreng");
$pangsitBasah = new SideDish("Pangsit Basah Mala", 13500, "Pangsit Kuah");
$chickenRoll = new SideDish("Chicken Roll Nuosa", 13000, "Gorengan");

// --- Skenario Pesanan ---
$pesananBudi = new Pesanan("Budi (Take Away)");
$pesananBudi->tambahItem($bakmieMalaSpesial);
$pesananBudi->tambahItem($pangsitGoreng);
$pesananBudi->tambahItem($pangsitGoreng); // Beli 2 porsi

// Terapkan diskon
$pesananBudi->beriDiskon(10); // Diskon 10%

// Proses pesanan
try {
    $struk = $kasir->prosesPesanan($pesananBudi);
} catch (Exception $e) {
    echo "<p style='color: red;'>Error: " . $e->getMessage() . "</p>";
}

// Menyiapkan data untuk View
$data = [
    'pesanan' => $pesananBudi,
    'struk' => $struk ?? null,
    'totalPesananHariIni' => Kasir::getTotalPesananDiproses()
];

// PERBAIKAN DI SINI: Sesuaikan nama file menjadi 'Struk_view.php'
require_once 'Views/Struk_view.php';