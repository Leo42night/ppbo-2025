<?php

namespace App\Controllers; // Tambahkan ini

trait Loggable {
    public function log(string $message): void {
        echo "<p style='color: green;'>[LOG]: " . htmlspecialchars($message) . "</p>";
    }
}