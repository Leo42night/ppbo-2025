<?php
require_once __DIR__ . '/autoload.php';

// pakai use biar singkat
use App\Controller\MenuController;
use App\Repository\MenuRepository;
use App\View\MenuView;
use App\Model\Makanan;
use App\Model\Minuman;
use App\Model\Promo;
use App\Model\PromoSpesial;
use App\Model\Admin;
use App\Model\MenuValidator;
use App\Model\HargaInvalidException;
use App\Service\OrderService;


// MVC + CRUD

$controller = new MenuController(new MenuRepository(), new MenuView());
$controller->seedData();
$controller->tampilkanMenu();

echo "\n";
// Exception Handling

try {
    MenuValidator::validateHarga(-5000);
} catch (HargaInvalidException $e) {
    echo "Error: {$e->getMessage()}\n";
} finally {
    echo "Validasi harga selesai.\n";
}

echo "\n";
// Late Static Binding
echo Promo::info() ."\n";
echo PromoSpesial::info() ."\n";

echo "\n";
// Final Class

$admin = new Admin("Budi");
echo $admin->getRole() . "\n";

echo "\n";
// Iterator

$repo = new MenuRepository();
$repo->tambah(new Makanan("Bakso", 15000));
$repo->tambah(new Minuman("Jus Alpukat", 12000));
foreach ($repo as $item) {
    echo "Iterasi: $item\n";
}

echo "\n";
// Dependency Injection

$orderService = new OrderService($repo);
$orderService->pesan(new Makanan("Ayam Geprek", 20000));
echo "Pesanan berhasil ditambahkan\n";

echo "\n";
// Serialization

$makanan = new Makanan("Sate Ayam", 25000);
$serialized = serialize($makanan);
echo "Serialized: $serialized\n";
$unserialized = unserialize($serialized);
echo "Unserialized: $unserialized\n";

echo "\n";
// Reflection

$reflect = new ReflectionClass(Makanan::class);
echo "Class: " . $reflect->getName() . "\n";
echo "Methods: " . implode(", ", array_map(fn($m) => $m->getName(), $reflect->getMethods())) . "\n";

echo "\n";
// Cloning
$teh = new Minuman("Teh Manis", 10000);
$tehClone = clone $teh;
echo "Cloned: $tehClone\n";

echo "\n";
// Anonymous Class

$anon = new class("Roti Bakar", 12000) extends Makanan {
    public function ekstra() {
        return "Bonus selai coklat!";
    }
};
echo $anon . " + " . $anon->ekstra() . "\n";
