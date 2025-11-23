<?php
namespace App\Support;

final class IdGenerator
{
    public static function generate(): string
    {
        return bin2hex(random_bytes(6));
    }
}
