<?php
namespace Models;

abstract class Media {
    protected string $title;
    
   
    private static int $counter = 0;

    public function __construct(string $title) {
        $this->title = $title;
        self::$counter++; 
    }

    abstract public function getDetails(): string;

    public function getTitle(): string {
        return $this->title;
    }
    
    public static function getObjectCount(): int {
        return self::$counter;
    }


    final public function getCopyright(): string {
        return "© 2025 Digital Library. All rights reserved.";
    }
}