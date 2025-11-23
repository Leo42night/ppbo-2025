<?php
// 12. Static Properties & Methods, 13. Namespaces
namespace PerpustakaanOOP\Utils;

class Database {
    // 12. Static Property
    private static array $koleksiBuku = [];

    // 12. Static Method
    public static function getConnection(): string {
        return "Simulasi koneksi database: MySQL (Singleton pattern)";
    }

    // 12. Static Method untuk simulasi CRUD data
    public static function getKoleksiBuku(): array {
        return self::$koleksiBuku;
    }

    // 12. Static Method
    public static function simpanBuku(object $buku): void {
        $isbn = $buku->getIsbn(); // Asumsi Buku memiliki method getIsbn
        self::$koleksiBuku[$isbn] = $buku;
    }
    
    // Static method untuk simulasi menghapus
    public static function hapusBuku(string $isbn): bool {
        if (isset(self::$koleksiBuku[$isbn])) {
            unset(self::$koleksiBuku[$isbn]);
            return true;
        }
        return false;
    }
}