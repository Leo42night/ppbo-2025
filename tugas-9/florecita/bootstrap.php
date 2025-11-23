<?php
declare(strict_types=1);
namespace LaundryApp;

spl_autoload_register(function ($class) {
    $prefix = 'LaundryApp\\';
    $base_dir = __DIR__ . '/src/';
    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) return;
    $relative = substr($class, $len);
    $file = $base_dir . str_replace('\\', '/', $relative) . '.php';
    if (file_exists($file)) require $file;
});

define('DATA_FILE', __DIR__ . '/data/services.json');
if (!file_exists(DATA_FILE)) {
    file_put_contents(DATA_FILE, json_encode([]));
}
