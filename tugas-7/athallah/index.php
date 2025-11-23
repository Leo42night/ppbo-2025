<?php

spl_autoload_register(function ($class) {
    $file = __DIR__ . '/' . str_replace('\\', '/', $class) . '.php';
    if (file_exists($file)) {
        require $file;
    }
});

use App\Models\Book;
use App\Controllers\Library;
use App\Services\Database;

echo "<h1>Selamat Datang di Perpustakaan Digital v3 (Final)</h1>";
echo "<hr>";

// === DEPENDENCY INJECTION ===
$dbConnection = new Database();
$myLibrary = new Library($dbConnection);
echo "<hr>";

$book1 = new Book("Dilan 1990", "Pidi Baiq", "978-602-0851-56-3");
$book2 = new Book("Laskar Pelangi", "Andrea Hirata");
$myLibrary->addBook($book1);
$myLibrary->addBook($book2);
echo "<hr>";

// === OBJECT CLONING ===
echo "<h3>Demonstrasi Cloning Object</h3>";
$book1_copy = clone $book1;
$myLibrary->addBook($book1_copy);
echo "<hr>";

// === OBJECT SERIALIZATION (DINONAKTIFKAN KARENA MASALAH PERMISSION) ===
echo "<h3>Demonstrasi Serialization (Fitur Dinonaktifkan di Server Ini)</h3>";
/*
// 1. Mengubah objek menjadi string dan menyimpannya
$serializedLibrary = serialize($myLibrary);
file_put_contents('library.backup', $serializedLibrary);
echo "<p>Objek Library telah disimpan ke file 'library.backup'.</p>";

// 2. Hapus objek dari memori (hanya untuk simulasi)
unset($myLibrary);

// 3. Memulihkan objek dari file
$savedState = file_get_contents('library.backup');
$restoredLibrary = unserialize($savedState);
echo "<p>Objek Library telah dipulihkan dari backup.</p>";
echo "<hr>";
*/

// Menyiapkan data dari objek ASLI, bukan dari hasil restore
$books = $myLibrary->listAllBooks();
$totalBooks = Book::getTotalBooks();

// Memuat file View untuk menampilkan data
require_once 'views/library_view.php';