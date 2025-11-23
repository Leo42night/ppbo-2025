<?php
require 'autoload.php';

use PerpustakaanOOP\Model\Buku;
use PerpustakaanOOP\Model\BukuFiksi;
use PerpustakaanOOP\Model\Pustakawan;
use PerpustakaanOOP\Model\KepalaPerpustakaan;
use PerpustakaanOOP\View\BukuView;
use PerpustakaanOOP\Controller\BukuController;
use PerpustakaanOOP\Utils\LibraryException;
use PerpustakaanOOP\Utils\Database;

echo "<h1> Perpustakaan Mengimplementasikan 20 Materi</h1>";

// Inisialisasi Objek Awal
$bukuView = new BukuView();
$bukuController = new BukuController($bukuView); // 18. Dependency Injection
$buku1 = new Buku("OOP for Dummies", "978-0061120084", "J. Doe", 2023, 10);
$buku2 = new BukuFiksi("Misteri Gunung", "978-6020334800", "A. Setyo", 2020, 5, "Thriller");

// ----------------------------------------------------
echo "<h2>1. Scope: public, private, protected & 2. Encapsulation</h2>";
echo "Judul Buku 1: " . $buku1->getJudul() . "<br>";
echo "Catatan: Data Stok dan ISBN menggunakan private/protected (Encapsulation).<br>";

// ----------------------------------------------------
echo "<h2>3. Magic Methods: __construct(), __get(), __set(), __toString()</h2>";
echo "3.1. __construct(): Buku 1 dan 2 telah dibuat saat inisialisasi objek.<br>";
echo "3.2. __toString(): Buku 1: " . $buku1 . "<br>"; // Panggil __toString()
$buku1->penulis = "John R. Doe"; // Panggil __set()
echo "3.3. __set() & __get(): Nama Penulis Buku 1 diubah dan diambil: " . $buku1->penulis . "<br>";
echo "3.4. __get(): Mencari Properti 'penerbit' yang tidak didefinisikan (diambil dari Class Constant): " . $buku1->penerbit . "<br>"; // Panggil __get()

// ----------------------------------------------------
echo "<h2>4. Inheritance & 11. Polymorphism (Abstract/Override)</h2>";
echo "4.1. Inheritance & Override: Buku Fiksi menampilkan informasi tambahan= " . $buku2 . "<br>";
$pustakawan = new Pustakawan("Budi Santoso", "NIP001");
$kepala = new KepalaPerpustakaan("Cahya Dewi", "NIP002");
echo "4.2. Peran Staf: Pustakawan: " . $pustakawan->peran() . "<br>";

// ----------------------------------------------------
echo "<h2>5. Class Constants</h2>";
echo "Akses Konstanta Penerbit (Default Value): " . Buku::DEFAULT_PENERBIT . "<br>";
echo "Akses Konstanta Role Staf (Default Value): " . Pustakawan::ROLE . "<br>";

// ----------------------------------------------------
echo "<h2>6. Late Static Binding (LSB): static:: vs self::</h2>";
// LSB memastikan Role diambil dari class turunan (KepalaPerpustakaan)
echo "Role Pustakawan: " . $pustakawan->peran() . "<br>";
echo "Role Kepala Perpustakaan: " . $kepala->peran() . "<br>";

// ----------------------------------------------------
echo "<h2>7. Final Keyword: final class & final function</h2>";
echo "Stok Buku 1 sebelum ditambah: " . $buku1->getJumlahStok() . "<br>";
$buku1->tambahStok(5); // Memanggil method final
echo "Stok Buku 1 setelah ditambah: " . $buku1->getJumlahStok() . "<br>";
echo "Status: Penambahan stok menggunakan Final Method.<br>";
// Catatan: Class BukuFiksi dideklarasikan sebagai 'final class' (tidak bisa diturunkan lagi).

// ----------------------------------------------------
echo "<h2>8. Type Hinting & Return Types (Union types)</h2>";
echo "Status: Type Hinting (`string`, `:int`, `:string|int`) digunakan di hampir semua method dan properti.<br>";

// ----------------------------------------------------
echo "<h2>9. Exception Handling: try, catch, finally</h2>";
try {
    // Simulasi Exception
    throw new LibraryException("Stok buku tidak valid", 500);
} catch (LibraryException $e) {
    echo "9.1. Catch (Custom Exception): Terjadi Error Sistem: " . $e->getCustomErrorMessage() . "<br>";
} finally {
    echo "9.2. Blok finally selalu dijalankan.<br>";
}

// ----------------------------------------------------
echo "<h2>10. Trait (TimestampTrait)</h2>";
// Trait digunakan di kelas Buku
echo "Waktu Pencatatan Buku 1 (dari Trait): " . $buku1->getTanggalDibuat() . "<br>";

// ----------------------------------------------------
echo "<h2>11. Polymorphism (Interface/Abstract Class)</h2>";
echo "Status: Polymorphism diterapkan melalui Abstract Class (AnggotaPerpustakaan) dan Interface (AuditInterface).<br>";
echo "Output Interface: Staf Budi Santoso melakukan tugas wajib: " . $pustakawan->lakukanAudit() . "<br>"; // Implementasi Interface/Polymorphism

// ----------------------------------------------------
echo "<h2>12. Static Properties & Methods</h2>";
echo "Akses ke Utilitas Database (tanpa objek): " . Database::getConnection() . "<br>";
echo "Data Koleksi dikelola secara statis melalui `Database::simpanBuku()` dan `Database::getKoleksiBuku()`.<br>";

// ----------------------------------------------------
echo "<h2>13. Namespaces & Autoloading</h2>";
echo "Status: Class dimuat otomatis via autoload.php. Semua class menggunakan namespace `PerpustakaanOOP\\...` dan diakses dengan `use`.<br>";

// ----------------------------------------------------
echo "<h2>14. Penerapan membuat CRUD & MVC Sederhana</h2>";
// 14.1. CRUD (Create)
$bukuController->tambahBuku($buku1); 
$bukuController->tambahBuku($buku2);
// 14.2. MVC (View)
echo $bukuController->index(); // Menampilkan daftar buku via Controller & View

// ----------------------------------------------------
echo "<h2>15. Object Serialization: serialize(), unserialize(), __sleep(), & __wakeup()</h2>";
$serializedBuku = serialize($buku1); // Memanggil __sleep()
$displayString = htmlspecialchars($serializedBuku);
$maxLength = 120; // Batasi tampilan
if (strlen($displayString) > $maxLength) {
    $displayString = substr($displayString, 0, $maxLength) . '... [Dipotong agar rapi]';
}

echo "15.1. Serialized (Data mentah, dipotong): " . $displayString . "<br>";
$unserializedBuku = unserialize($serializedBuku); // Memanggil __wakeup()
echo "15.2. Unserialized (Objek dimuat kembali): " . $unserializedBuku . "<br>";

// ----------------------------------------------------
echo "<h2>16. Object Iteration: IteratorAggregate</h2>";
echo "Iterasi Data Inti Objek Buku 1: ";
echo "<ul>";
foreach ($buku1 as $key => $value) {
    echo "<li>$key: $value</li>";
}
echo "</ul>";

// ----------------------------------------------------
echo "<h2>17. Reflection</h2>";
echo "Status: Pemeriksaan struktur class dilakukan secara dinamis di file Refleksi.php.<br>";

// ----------------------------------------------------
echo "<h2>18. Dependency Injection (DI)</h2>";
echo "Status: Dependency Injection diterapkan di awal script: `\$bukuController = new BukuController(\$bukuView);`. (View diinjeksikan ke Controller).<br>";

// ----------------------------------------------------
echo "<h2>19. Cloning Object: clone & __clone()</h2>";
$bukuClone = clone $buku1; // Keyword clone & __clone() dipanggil
echo "19.1. Buku Asli: ISBN " . $buku1->getIsbn() . " | Buku Salinan: ISBN " . $bukuClone->getIsbn() . " <br>";
echo "19.2. Data Buku Salinan: " . $bukuClone . "<br>";

// ----------------------------------------------------
echo "<h2>20. Anonymous Class</h2>";
$log = new class('Perpustakaan') {
    public function log(string $message): void {
        echo "[LOG] " . date('Y-m-d H:i:s') . ": $message<br>";
    }
};
$log->log("Selesai mendemonstrasikan 20 materi.");

// Membersihkan database (Simulasi)
echo "<br>-- Membersihkan Simulasi Database --<br>";
$bukuController->hapusBuku($buku1->getIsbn());
$bukuController->hapusBuku($buku2->getIsbn());
?>