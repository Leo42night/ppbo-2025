<?php
// 13. Namespaces & Autoloading (spl_autoload_register)

spl_autoload_register(function ($className) {
    // Prefix namespace proyek
    $prefix = 'PerpustakaanOOP\\';
    // Base directory untuk class
    $baseDir = __DIR__ . '/src/';

    // Apakah class menggunakan prefix namespace?
    $len = strlen($prefix);
    if (strncmp($prefix, $className, $len) !== 0) {
        return; // Tidak, pindah ke autoloader berikutnya (jika ada)
    }

    // Mendapatkan nama class relatif
    $relativeClass = substr($className, $len);

    // Mengganti namespace separator dengan directory separator, tambahkan .php
    $file = $baseDir . str_replace('\\', '/', $relativeClass) . '.php';

    // Jika file ada, require-kan
    if (file_exists($file)) {
        require $file;
    }
});