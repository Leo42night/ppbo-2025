<?php

namespace App\Core;

// 13. Static Properties & Methods
final class Database // 8. Final Keyword (Class)
{
    private static ?\PDO $instance = null;

    private function __construct() {}
    private function __clone() {}

    public static function getInstance(): \PDO
    {
        if (self::$instance === null) {
            try {
                // Menggunakan SQLite untuk simplisitas, tidak perlu setup server DB
                self::$instance = new \PDO('sqlite::memory:');
                self::$instance->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
                self::$instance->exec("CREATE TABLE IF NOT EXISTS products (
                    id INTEGER PRIMARY KEY,
                    type TEXT NOT NULL,
                    name TEXT NOT NULL,
                    price REAL NOT NULL,
                    details TEXT NOT NULL
                )");
            } catch (\PDOException $e) {
                die("Koneksi database gagal: " . $e->getMessage());
            }
        }
        return self::$instance;
    }
}