<?php
namespace App\Trait;

trait Loggable
{
    public static function log(string $message): void // Static method (12) di Trait (10)
    {
        error_log('[LOG] ' . $message);
    }

    protected function logInstance(string $message): void
    {
        self::log($message);
    }
}
