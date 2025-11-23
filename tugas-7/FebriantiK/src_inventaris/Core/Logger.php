<?php
namespace InventoryApp\Core;

// Trait: Menyediakan method yang bisa dipakai ulang di berbagai class.
trait Logger {
    public function log(string $message): void {
        echo "[LOG] " . $message . PHP_EOL;
    }
}