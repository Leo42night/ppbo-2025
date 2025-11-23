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

$dbConnection = new Database();
$myLibrary = new Library($dbConnection);
echo "<hr>";

$book1 = new Book("Dilan 1990", "Pidi Baiq", "978-602-0851-56-3");
$book2 = new Book("Laskar Pelangi", "Andrea Hirata");
$myLibrary->addBook($book1);
$myLibrary->addBook($book2);
echo "<hr>";

echo "<h3>Demonstrasi Cloning Object</h3>";
$book1_copy = clone $book1;
$myLibrary->addBook($book1_copy);
echo "<hr>";

echo "<h3>Demonstrasi Object Serialization</h3>";
echo "<p><b>Langkah 1: Menyimpan state objek...</b></p>";
$serializedLibrary = serialize($myLibrary);
file_put_contents('library.backup', $serializedLibrary);
echo "<p>Objek Library telah disimpan ke file 'library.backup'.</p>";
echo "<p><b>Langkah 2: Menghapus objek dari memori (simulasi)...</b></p>";
unset($myLibrary);
echo "<p>Objek \$myLibrary telah dihapus (unset).</p>";
echo "<p><b>Langkah 3: Memulihkan objek dari file...</b></p>";
$savedState = file_get_contents('library.backup');
$restoredLibrary = unserialize($savedState);
echo "<p>Objek Library telah dipulihkan dari backup.</p>";
echo "<hr>";

echo "<h3>Demonstrasi Exception Handling (try, catch, finally)</h3>";
echo "<b>Skenario 1: Mencari buku yang ada...</b>";
try {
    $foundBook = $restoredLibrary->findBookById($book1->getIdentifier());
    echo "<p style='color: blue;'>[SUCCESS]: Berhasil menemukan buku '{$foundBook->getTitle()}'.</p>";
} catch (Exception $e) {
    echo "<p style='color: red;'>[ERROR]: " . $e->getMessage() . "</p>";
} finally {
    echo "<p style='color: #555;'>[FINALLY]: Proses pencarian pertama selesai.</p>";
}
echo "<br>";
echo "<b>Skenario 2: Mencari buku yang tidak ada...</b>";
try {
    $nonExistentId = 'ID-YANG-SALAH-123';
    echo "<p>Mencoba mencari buku dengan ID: {$nonExistentId}...</p>";
    $foundBook = $restoredLibrary->findBookById($nonExistentId);
    echo "<p style='color: blue;'>[SUCCESS]: Berhasil menemukan buku.</p>";
} catch (Exception $e) {
    echo "<div style='border: 2px solid red; padding: 10px; background: #ffebee;'>";
    echo "<b>[CATCH]: Oops, terjadi error yang berhasil ditangani!</b><br>";
    echo "Pesan Error: " . htmlspecialchars($e->getMessage());
    echo "</div>";
} finally {
    echo "<p style='color: #555;'>[FINALLY]: Proses pencarian kedua selesai.</p>";
}
echo "<hr>";

echo "<h3>Demonstrasi Reflection API: Menganalisis Class Library</h3>";
try {
    $reflector = new ReflectionClass('App\Controllers\Library');
    echo "<div style='border: 1px solid #999; padding: 10px; background-color: #f9f9f9;'>";
    echo "<h4>Hasil Analisis Class: " . htmlspecialchars($reflector->getName()) . "</h4>";
    echo "<b>Properti yang dimiliki:</b><ul>";
    $properties = $reflector->getProperties();
    foreach ($properties as $prop) {
        echo "<li>" . htmlspecialchars($prop->getName()) . " (" . implode(' ', Reflection::getModifierNames($prop->getModifiers())) . ")</li>";
    }
    echo "</ul>";
    echo "<b>Method yang dimiliki:</b><ul>";
    $methods = $reflector->getMethods();
    foreach ($methods as $method) {
        echo "<li>" . htmlspecialchars($method->getName()) . "() (" . implode(' ', Reflection::getModifierNames($method->getModifiers())) . ")</li>";
    }
    echo "</ul>";
    echo "<b>Trait yang digunakan:</b><ul>";
    $traits = $reflector->getTraitNames();
    foreach ($traits as $trait) {
        echo "<li>" . htmlspecialchars($trait) . "</li>";
    }
    echo "</ul>";
    echo "</div>";
} catch (ReflectionException $e) {
    echo "<p style='color: red;'>Gagal melakukan refleksi: " . $e->getMessage() . "</p>";
}
echo "<hr>";

echo "<h3>Demonstrasi Anonymous Class</h3>";
$temporaryLogger = new class {
    public function log(string $message): void {
        $timestamp = date('Y-m-d H:i:s');
        echo "<p style='color: #6a0dad; font-style: italic;'>[TEMP LOG - {$timestamp}]: " . htmlspecialchars($message) . "</p>";
    }
};
$temporaryLogger->log("Ini adalah pesan dari logger sementara yang dibuat dengan Anonymous Class.");
$restoredLibrary->addBook(new App\Models\Book("Buku dari Proses Anonim", "Sistem"));
echo "<hr>";

$books = $restoredLibrary->listAllBooks();
$totalBooks = Book::getTotalBooks();
require_once 'views/library_view.php';