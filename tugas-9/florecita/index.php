<?php
declare(strict_types=1);
namespace LaundryApp;

use LaundryApp\Controller\ServiceController;

require __DIR__ . '/bootstrap.php';

$controller = new ServiceController();
$method = $_GET['action'] ?? ($_SERVER['REQUEST_METHOD'] === 'POST' ? 'api' : 'index');

try {
    if ($method === 'api') {
        header('Content-Type: application/json');
        echo $controller->api();
    } else {
        echo $controller->index();
    }
} catch (\Throwable $e) {
    http_response_code(500);
    echo "<h1>Internal Error</h1><pre>" . htmlspecialchars($e) . "</pre>";
}
