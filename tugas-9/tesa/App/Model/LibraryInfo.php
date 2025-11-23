<?php
namespace App\Model;

final class LibraryInfo {
    public static $namaPerpustakaan = "Perpustakaan FMIPA";

    public static function info() {
        echo "Nama Perpustakaan: " . self::$namaPerpustakaan . "\n";
    }
}