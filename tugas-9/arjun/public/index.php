<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/../autoload.php';

// Konsep: Namespaces & Autoloading (menggunakan 'use')
// TAMBAHKAN BAGIAN INI untuk meng-import semua class yang dibutuhkan
use Core\Library;
use Models\Book;
use Models\Movie;
use Exceptions\ItemNotFoundException;
use Interfaces\Loggable;

// CSS sederhana untuk tampilan
echo "<style>body { font-family: sans-serif; line-height: 1.6; } h2, h3 { color: #2c3e50; } b { color: #2980b9; } i { color: #7f8c8d; font-size: 0.9em; }</style>";

// Konsep: Anonymous Class untuk logger
$consoleLogger = new class implements Loggable {
    public function log(string $message): void {
        echo "[LOG]: " . htmlspecialchars($message) . "<br>";
    }
};

echo "<h2>🚀 Memulai Sistem Perpustakaan Digital</h2>";

// 1. Dependency Injection: Logger dimasukkan ke Library
// Panggil dengan nama pendek: 'Library' bukan 'Core\Library'
$myLibrary = new Library($consoleLogger); 

// 2. Menambahkan item (Book dan Movie)
// Panggil dengan nama pendek: 'Book' dan 'Movie'
$book1 = new Book("PHP OOP Mastery", "John Doe");
$movie1 = new Movie("The Matrix", 1999);
$myLibrary->addItem($book1);
$myLibrary->addItem($movie1);

// 3. Menampilkan detail (Polymorphism & Late Static Binding)
echo "<h3>Detail Item</h3>";
// Panggil dengan nama pendek: 'Book::' dan 'Movie::'
echo "<p>" . $book1->getDetails() . " (Tipe: " . Book::getMediaType() . ")</p>";
echo "<p>" . $movie1->getDetails() . " (Tipe: " . Movie::getMediaType() . ")</p>";

// 4. Menggunakan Magic Method (__toString dan __get)
echo "<p><b>Info Library:</b> " . $myLibrary . "</p>";
echo "<p><b>Total Items (dari __get):</b> " . $myLibrary->totalItems . "</p>";

// 5. Exception Handling
echo "<h3>Mencari Item...</h3>";
try {
    $foundItem = $myLibrary->findItemById(1);
    echo "Ditemukan: " . $foundItem->getDetails() . "<br>";
    $myLibrary->findItemById(99); // Ini akan gagal
} catch (ItemNotFoundException $e) { // Panggil dengan nama pendek
    echo "<b>Error:</b> " . $e->getMessage() . "<br>";
} finally {
    echo "Proses pencarian selesai.<br>";
}

// 6. Object Iteration (foreach)
echo "<h3>Daftar Koleksi:</h3>";
foreach ($myLibrary as $item) {
    echo "- " . htmlspecialchars($item->getTitle()) . "<br>";
}

// 7. Object Serialization
echo "<h3>Serialisasi & Kloning</h3>";
$serializedLibrary = serialize($myLibrary);
unset($myLibrary); // Hapus object asli (akan memicu __destruct)
$restoredLibrary = unserialize($serializedLibrary);
echo "<b>Info Library yg Dipulihkan:</b> " . $restoredLibrary . "<br>";

// 8. Cloning Object
$clonedLibrary = clone $restoredLibrary;
echo "<b>Info Library yg Di-clone:</b> " . $clonedLibrary . "<br>";

echo "<h3>✨ Program Selesai</h3>";
?></body>
</html>