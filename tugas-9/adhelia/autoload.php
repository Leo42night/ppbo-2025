<?php
spl_autoload_register(function ($class) {
    $prefix = "App\\";
    $base_dir = __DIR__ . "/App/";

    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        return; // bukan class App\
    }

    $relative_class = substr($class, $len);
    $file = $base_dir . str_replace("\\", "/", $relative_class) . ".php";

    if (file_exists($file)) {
        require $file;
    } else {
        die("⚠ Autoload gagal cari file: $file\n");
    }
});