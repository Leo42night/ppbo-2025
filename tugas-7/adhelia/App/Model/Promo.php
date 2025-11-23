<?php
namespace App\Model;

class Promo {
    protected static float $diskon = 0.1;

    public static function getDiskon(): float {
        return static::$diskon; // late static binding
    }

    public static function info(): string {
        return "Diskon: " . (self::$diskon * 100) . "% (self) | " .
               (static::$diskon * 100) . "% (static)";
    }
}

class PromoSpesial extends Promo {
    protected static float $diskon = 0.3;
}
