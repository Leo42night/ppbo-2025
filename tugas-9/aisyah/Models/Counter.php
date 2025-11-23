<?php
namespace PerpustakaanApp\Models;

class Counter {
    protected static int $count = 0;
    
    public static function increment(): void {
        static::$count++;
    }
    
    public static function getCount(): int {
        return static::$count;
    }
    
    public static function reset(): void {
        static::$count = 0;
    }
}
