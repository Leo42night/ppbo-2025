<?php
// Namespaces & Autoloading (PSR-4)
spl_autoload_register(function ($class) {
    // Tentukan prefix namespace proyek
    $prefix = 'InventoryApp\\';
    // Tentukan base directory untuk file class
    $base_dir = __DIR__ . '/src_inventaris/';

    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        return;
    }

    $relative_class = substr($class, $len);
    $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';

    if (file_exists($file)) {
        require $file;
    }
});