<?php

namespace App\Traits;

// 11. Trait
trait Logger
{
    public function log(string $message): void
    {
        // Simulasi logging ke file atau console
        echo "LOG: [". date('Y-m-d H:i:s') ."] " . $message . "<br>";
    }
}