<?php
namespace Core;

trait Logger {
    public function log($msg) {
        echo "[LOG] $msg\n";
    }
}
