<?php
namespace App\Utils;

trait Logger {
    public function log(string $msg) {
        echo "[LOG] $msg\n";
    }
}