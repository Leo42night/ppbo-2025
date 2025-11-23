<?php

namespace App\Services;

class Pencatat {
    public function catat(string $pesan): void {
        echo "<p style='color: blue;'>[CATATAN]: " . htmlspecialchars($pesan) . "</p>";
    }
}