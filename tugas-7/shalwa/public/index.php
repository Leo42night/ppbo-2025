<?php

declare(strict_types=1);

// Autoloader
spl_autoload_register(function (string $class) {
    $prefix = 'App\\';
    $baseDir = __DIR__ . '/../App/';
    if (strncmp($prefix, $class, strlen($prefix)) !== 0) return;
    $relative = substr($class, strlen($prefix));
    $file = $baseDir . str_replace('\\', '/', $relative) . '.php';
    if (is_file($file)) require $file;
});

// Hapus semua require ke vendor/laravel atau path aneh.
// (Tidak boleh ada require ke ".Joe/CoreContainer.php" atau semacamnya.)

if($_SERVER['HTTP_HOST'] === 'localhost:8080' || $_SERVER['HTTP_HOST'] === '127.0.0.1:8080') {
    define('BASE_URL', '/pbo/shalwa');
} else {
    define('BASE_URL', '');
}

use App\Core\View;
use App\Controller\BookController;
use App\Repository\RepositoryInterface;
use App\Repository\BookRepository;

session_start();

$expected = __DIR__ . '/../App/Core/Container.php';
echo "<!-- exists: " . (file_exists($expected) ? 'yes' : 'no') . " -->";
if (file_exists($expected)) {
    require_once $expected;
    echo "<!-- class_exists: " . (class_exists('\App\Core\Container') ? 'yes' : 'no') . " -->";
}

// Pakai FQCN penuh untuk memastikan
$container = new \App\Core\Container();
$container->set(View::class, fn() => new View(__DIR__));
$container->set(RepositoryInterface::class, fn() => new BookRepository());

$controller = BookController::factory($container);

$method = $_SERVER['REQUEST_METHOD'] ?? 'GET';
$path   = $_SERVER['REQUEST_URI'];
$path_url = parse_url($path, PHP_URL_PATH);
$baseUrl = BASE_URL;
if ($path === $baseUrl . '/' || $path === $baseUrl . '/books') {
    echo $controller->index();
} elseif ($path === $baseUrl . '/books/create' && $method === 'POST') {
    echo $controller->store($_POST);
} elseif ($path_url === $baseUrl . '/books/update' && $method === 'POST') {
    echo $controller->update($_POST);
} elseif ($path_url === $baseUrl . '/books/delete' && $method === 'POST') { // Leo: [error logic] trim path
    echo $controller->delete((int)($_POST['id'] ?? 0));
} elseif ($path_url === $baseUrl . '/books/show') { // Leo: [error logic] trim path
    echo $controller->show((int)($_GET['id'] ?? 0));
} else {
    http_response_code(404);
    $baseUrl = $baseUrl . '/books/show';
    echo "<h1>404</h1><p>Halaman tidak ditemukan</p><br>Path : $path, path_url: $path_url, BaseUrl : $baseUrl";
}
