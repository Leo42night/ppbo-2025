<?php

spl_autoload_register(function ($class) {
    $file = __DIR__ . '/' . str_replace('\\', '/', $class) . '.php';
    if (file_exists($file)) {
        require $file;
    }
});

use App\Models\Book;
use App\Models\Magazine;
use App\Controllers\Library;
use App\Services\Database;
use App\Models\Item;

echo "<h1>Selamat Datang di Perpustakaan Digital v3 (Final Enhanced)</h1>";
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

// === POLYMORPHISM ===
echo "<h3>Demonstrasi Polimorfisme (Method getSummary())</h3>";
$magazine1 = new Magazine("National Geographic", 150);
$allItems = [$book1, $book2, $magazine1];
echo "<ul>";
foreach ($allItems as $item) {
    // Memanggil method yang sama (getSummary) pada objek yang berbeda (Book, Magazine)
    echo "<li>" . htmlspecialchars($item->getSummary()) . "</li>";
}
echo "</ul>";
echo "<hr>";


// === EXCEPTION HANDLING ===
echo "<h3>Demonstrasi Exception Handling</h3>";
try {
    echo "<p>Mencoba mencari buku dengan ID yang ada (ID: {$book1->getIdentifier()})...</p>";
    $foundBook = $myLibrary->findBookById($book1->getIdentifier());
    echo "<p style='color: green;'>Buku ditemukan: " . htmlspecialchars($foundBook->getTitle()) . "</p>";

    echo "<p>Mencoba mencari buku dengan ID yang TIDAK ada (ID: 'id-salah')...</p>";
    $myLibrary->findBookById('id-salah'); // Baris ini akan memicu Exception

} catch (Exception $e) {
    // Tangkap exception dan tampilkan pesannya dengan rapi
    echo "<p style='color: red;'>Terjadi sebuah error: " . htmlspecialchars($e->getMessage()) . "</p>";

} finally {
    // Blok ini akan selalu dieksekusi, baik ada error maupun tidak
    echo "<p style='color: gray;'>Blok 'finally' selesai dieksekusi. Proses pencarian selesai.</p>";
}
echo "<hr>";


// === OBJECT SERIALIZATION (DENGAN PERBAIKAN PERMISSION) ===
echo "<h3>Demonstrasi Serialization dengan __sleep dan __wakeup</h3>";

// Membuat path file di direktori sementara yang diizinkan server
$backupFile = sys_get_temp_dir() . '/library.backup'; 

// 1. Mengubah objek menjadi string dan menyimpannya
file_put_contents($backupFile, serialize($myLibrary));
echo "<p>Objek Library telah disimpan ke file '{$backupFile}'.</p>";


// 2. Hapus objek dari memori (hanya untuk simulasi)
unset($myLibrary);
echo "<p>Objek Library asli telah dihapus dari memori.</p>";

// 3. Memulihkan objek dari file
$savedState = file_get_contents($backupFile); // Membaca dari path yang sama
$restoredLibrary = unserialize($savedState);
echo "<p>Objek Library telah dipulihkan dari backup.</p>";

// Buktikan bahwa objek yang dipulihkan berfungsi
echo "<p>Mencoba menambahkan buku baru ke library yang sudah dipulihkan...</p>";
$book3 = new Book("Bumi Manusia", "Pramoedya Ananta Toer");
$restoredLibrary->addBook($book3);
echo "<hr>";


// === ANONYMOUS CLASS ===
echo "<h3>Demonstrasi Anonymous Class</h3>";
// Kita membuat item "spesial" yang mewarisi sifat dari Book,
// tapi dengan format __toString yang berbeda, tanpa membuat file class baru.
$specialItem = new class("Buku Edisi Terbatas", "Penulis Misterius") extends Book {
    public function __toString(): string {
        // Override method __toString khusus untuk objek ini saja
        return "✨ [EDISI SPESIAL] " . $this->getTitle() . " oleh " . $this->getAuthor() . " ✨";
    }
};
echo "<p>Menambahkan item spesial ke library (yang sudah di-restore)...</p>";
$restoredLibrary->addBook($specialItem); // Bisa ditambahkan karena merupakan turunan Book
echo "<p>Output dari item spesial: <b>" . htmlspecialchars($specialItem) . "</b></p>";
echo "<hr>";


// === REFLECTION API ===
echo "<h3>Demonstrasi Reflection API pada Class 'Library'</h3>";
$reflection = new ReflectionClass(Library::class);
echo "<h4>Properties:</h4>";
echo "<ul>";
foreach ($reflection->getProperties() as $prop) {
    echo "<li>" . $prop->getName() . " (" . ($prop->isPrivate() ? 'private' : 'public') . ")</li>";
}
echo "</ul>";
echo "<h4>Methods:</h4>";
echo "<ul>";
foreach ($reflection->getMethods() as $method) {
    echo "<li>" . $method->getName() . "()</li>";
}
echo "</ul>";
echo "<h4>Constants:</h4>";
echo "<ul>";
foreach ($reflection->getConstants() as $name => $value) {
    echo "<li>" . htmlspecialchars($name) . " = " . htmlspecialchars($value) . "</li>";
}
echo "</ul>";
echo "<hr>";

// Menyiapkan data dari objek HASIL RESTORE
$books = $restoredLibrary->listAllBooks();
$totalBooks = Book::getTotalBooks();

// Memuat file View untuk menampilkan data
require_once 'views/library_view.php';