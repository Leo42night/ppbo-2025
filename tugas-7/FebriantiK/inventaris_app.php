<?php
echo "<pre>";
// ---- APLIKASI UTAMA ----
// File ini akan menjalankan semua demo OOP

// 1. Namespaces & Autoloading
require_once 'inventaris_loader.php';

use InventoryApp\Model\{Product, Phone, Laptop};
use InventoryApp\Service\Warehouse;
use InventoryApp\Exception\InventoryException;

echo "===== DEMO LENGKAP PHP OOP - INVENTARIS TOKO =====\n\n";

// 2. Anonymous Class & Dependency Injection
echo "--- 2. Anonymous Class & Dependency Injection ---\n";
$emailNotifier = new class {
    public function send(string $message): void {
        echo "[EMAIL NOTIFICATION] Mengirim: '$message'\n";
    }
};
$mainWarehouse = new Warehouse("Jakarta", $emailNotifier);
echo $mainWarehouse . "\n\n";

// 3. Menambahkan Produk (CRUD)
echo "--- 3. Menambahkan Produk ---\n";
$p1 = new Phone("Galaxy S25", 20000000, "Android 16");
$p2 = new Laptop("MacBook Pro M5", 45000000, 32);
$mainWarehouse->addProduct($p1);
$mainWarehouse->addProduct($p2);
echo "\n";

// 4. Magic Method __call & __toString
echo "--- 4. Magic Methods (__call, __toString) ---\n";
$mainWarehouse->notifyAdmins("Stok baru telah ditambahkan.");
echo $mainWarehouse . "\n\n";

// 5. Object Iteration (foreach)
echo "--- 5. Iterasi Produk di Gudang ---\n";
foreach ($mainWarehouse as $product) {
    // Polymorphism: getInfo() memiliki implementasi berbeda di Phone dan Laptop
    echo "- " . $product->getInfo() . "\n";
}
echo "\n";

// 6. Exception Handling
echo "--- 6. Exception Handling ---\n";
try {
    $mainWarehouse->removeProduct("Galaxy S25");
    $mainWarehouse->removeProduct("Produk Fiktif"); // Ini akan gagal
} catch (InventoryException $e) {
    echo "ERROR: " . $e->getMessage() . "\n";
} finally {
    echo "Proses penghapusan selesai.\n\n";
}

// 7. Late Static Binding & Class Constants
echo "--- 7. Late Static Binding & Constants ---\n";
echo Phone::getProductType() . " | Kategori Konstanta: " . Phone::CATEGORY . "\n";
echo Laptop::getProductType() . "\n\n";

// 8. Static Property & Method
echo "--- 8. Static Property & Method ---\n";
$branchWarehouse = new Warehouse("Bandung", $emailNotifier);
echo "Total Gudang yang ada: " . Warehouse::getTotalWarehouses() . "\n\n";

// 9. Object Serialization (__sleep, __wakeup)
echo "--- 9. Object Serialization ---\n";
$serialized = serialize($mainWarehouse);
echo "Data setelah serialize: " . $serialized . "\n";
$unserialized = unserialize($serialized);
echo "Data setelah unserialize: " . $unserialized . "\n\n";

// 10. Cloning Object (__clone)
echo "--- 10. Cloning Object ---\n";
$clonedWarehouse = clone $mainWarehouse;
echo "Gudang Asli: " . $mainWarehouse->location . "\n";
echo "Gudang Kloning: " . $clonedWarehouse->location . "\n\n";

// 11. Reflection API
echo "--- 11. Reflection API ---\n";
echo "Menganalisa class 'Laptop':\n";
$reflection = new ReflectionClass(Laptop::class);
echo "Nama Class: " . $reflection->getName() . "\n";
echo "Mengimplementasikan Interface: " . implode(', ', $reflection->getInterfaceNames()) . "\n";
$finalMethod = $reflection->getMethod('performDiagnostics');
echo "Punya method final 'performDiagnostics'? " . ($finalMethod->isFinal() ? 'Ya' : 'Tidak') . "\n";

echo "\n===== DEMO SELESAI =====\n";
echo "</pre>";