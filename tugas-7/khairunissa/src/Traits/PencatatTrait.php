<?php
// 10. Trait (trait): Reusable method
namespace AdopsiHewan\Traits;

trait PencatatTrait {
    public function log(string $pesan) {
        // Method yang bisa digunakan kembali di berbagai class
        echo "[LOG] " . date("Y-m-d H:i:s") . " - " . $pesan . "\n";
    }
}