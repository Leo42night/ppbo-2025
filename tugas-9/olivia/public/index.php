<?php

// 14. Namespaces & Autoloading
require_once __DIR__ . '/../vendor/autoload.php';

use App\Controllers\ProductController;
use App\Models\Book;
use App\Models\Electronics;
use App\Models\User;
use App\Services\Cart;
use App\Services\ReflectionService;

header('Content-Type: text/html; charset=utf-8');

echo "<h1>Demonstrasi Konsep OOP PHP</h1>";
echo "<hr>";

// Inisialisasi Controller (Menerapkan CRUD dan MVC)
$controller = new ProductController();

// 1. Membuat dan menyimpan objek (Inheritance, Encapsulation)
echo "<h2>1. CRUD & Inheritance</h2>";
$book = new Book("PHP OOP Lanjutan", 150000, "Gemini");
$electronics = new Electronics("Laptop Pro", 25000000, "Google");
$controller->save($book);
$controller->save($electronics);
echo "Buku dan Elektronik berhasil disimpan.<br>";

// 2. Mengambil dan menampilkan data (Polymorphism, MVC)
echo "<h3>Menampilkan Produk ID 1 (Buku):</h3>";
$controller->showProduct(1); // Ini akan me-render view
echo "<hr>";

// 3. Class Constants & Late Static Binding
echo "<h2>2. Class Constants & Late Static Binding</h2>";
echo "Tarif PPN: " . (App\Models\AbstractProduct::TAX * 100) . "%<br>";
$retrievedBook = $controller->findById(1);
echo $retrievedBook->getStorageInfo() . " (dipanggil dari object Book)<br>"; // Output: book_products
echo $controller->findById(2)->getStorageInfo() . " (dipanggil dari object Electronics)<br>"; // Output: products
echo "<hr>";

// 4. Trait, Dependency Injection & Object Iteration
echo "<h2>3. Trait, Dependency Injection & Object Iteration</h2>";
$user = new User("Andi", "andi@example.com");
$cart = new Cart($user); // DI: User di-inject ke Cart
$cart->addProduct($retrievedBook, 1);
$cart->addProduct($controller->findById(2), 2);
echo "<h3>Isi Keranjang Belanja (iterasi dgn foreach):</h3>";
foreach ($cart as $productId => $item) {
    echo "- " . $item['product']->getName() . " (Qty: " . $item['quantity'] . ")<br>";
}
echo "<strong>Total Belanja: Rp " . number_format($cart->getTotal(), 2) . "</strong><br>";
echo "<hr>";

// 5. Object Serialization
echo "<h2>4. Object Serialization</h2>";
$serializedCart = serialize($cart);
echo "Keranjang setelah di-serialize: <pre>" . htmlspecialchars($serializedCart) . "</pre>";
$unserializedCart = unserialize($serializedCart);
echo "Total belanja setelah di-unserialize: Rp " . number_format($unserializedCart->getTotal(), 2) . "<br>";
echo "<hr>";


// 6. Exception Handling
echo "<h2>5. Exception Handling</h2>";
echo "Mencoba mencari produk dengan ID 99...<br>";
$nonExistentProduct = $controller->findById(99);
if ($nonExistentProduct === null) {
    echo "Penanganan eksepsi berhasil: Produk tidak ditemukan.<br>";
}
echo "<hr>";


// 7. Magic Methods (__toString, __get, __set)
echo "<h2>6. Magic Methods</h2>";
echo "User object to string: " . $user . "<br>";
$user->last_login = date('Y-m-d'); // __set
echo "Last login (dari __get): " . $user->last_login . "<br>";
echo "<hr>";

// 8. Reflection
echo "<h2>7. Reflection API</h2>";
echo "Menganalisis class 'Book'...<br>";
$analysis = ReflectionService::analyzeClass($retrievedBook);
echo "<pre>" . print_r($analysis, true) . "</pre>";
echo "<hr>";

// 9. Cloning Object
echo "<h2>8. Cloning Object</h2>";
$user2 = clone $user;
echo "Original user: " . $user->getName() . "<br>";
echo "Cloned user: " . $user2->getName() . "<br>";
echo "<hr>";

// 10. Anonymous Class
echo "<h2>9. Anonymous Class</h2>";
$logger = new class {
    public function log(string $message) {
        echo "ANONYMOUS LOG: $message <br>";
    }
};
$logger->log("Ini adalah pesan dari logger anonim.");
echo "<hr>";