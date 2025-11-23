<?php
require_once __DIR__ . '/autoload.php';

use App\Controller\PerpustakaanController;
use App\Service\PerpustakaanService;
use App\Utils\Reflector;
use App\Model\Buku;

// Fungsi bantu untuk warna
function color($text, $colorCode) {
    return "\033[" . $colorCode . "m" . $text . "\033[0m";
}

// Fungsi untuk membuat garis pemisah
function separator($char = "=", $length = 60) {
    return str_repeat($char, $length);
}

// Header dekoratif
echo color(separator("=") . "\n", "36");
echo color("📚 SISTEM INFORMASI PERPUSTAKAAN v1.0 📚\n", "33;1");
echo color(separator("=") . "\n\n", "36");

// Inisialisasi controller & service
$controller = new PerpustakaanController();
$service = new PerpustakaanService($controller);

// Tambah data & simpan
$service->tambahSampleItems();
$controller->pinjamSemua();
$controller->simpanItems();

// Reflection
Reflector::refleksi(new Buku("Seporsi Mie Ayam", "Brian Khrisna", 2025, "12345ABC"));

// Info dan Counter

if (class_exists('App\\Model\\LibraryInfo')) {
    // call statically via string to avoid static analysis error when the class is missing
    call_user_func(['App\\Model\\LibraryInfo', 'info']);
} else {
    // fallback info when LibraryInfo class is not available
    echo color("Informasi Perpustakaan: ", "35;1") . color("Nama Perpustakaan Contoh\n", "37");
}
echo "\n" . color("Total Buku Dibuat: ", "32;1") . color(Buku::getCount(), "92") . "\n";
// Footer dengan efek berbeda
echo "\n" . color(separator("-") . "\n", "36");
echo color("✅ Operasi selesai pada " . date("d-m-Y H:i:s") . "\n", "34;1");
echo color(separator("-") . "\n", "36");
