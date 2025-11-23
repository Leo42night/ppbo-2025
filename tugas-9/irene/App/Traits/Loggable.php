<?php
namespace App\Traits;

trait Loggable {
    public function log(string $message): void {
        echo "[LOG] $message\n";
    }
}
