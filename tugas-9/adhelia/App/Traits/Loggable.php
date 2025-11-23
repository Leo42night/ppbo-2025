<?php
namespace App\Traits;

trait Loggable {
    public function log(string $msg): void {
        echo "[LOG] $msg\n";
    }
}