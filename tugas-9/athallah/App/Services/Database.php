<?php

namespace App\Services;

class Database {
    public function __construct() {
        echo "<p style='color: blue;'>[DB]: Koneksi database disimulasikan.</p>";
    }

    public function query(string $sql): void {
        echo "<p style='color: blue;'>[DB]: Menjalankan query: " . htmlspecialchars($sql) . "</p>";
    }
}