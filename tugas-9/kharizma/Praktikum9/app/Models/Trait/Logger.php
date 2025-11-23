<?php
namespace App\Models\Trait;

trait Logger {
    public function log($pesan) {
        $file = __DIR__ . '/../../../storage.log';
        $tanggal = date('Y-m-d H:i:s');
        file_put_contents($file, "[$tanggal] $pesan\n", FILE_APPEND);
    }
}
