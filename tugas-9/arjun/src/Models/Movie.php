<?php
namespace Models;

class Movie extends Media {
    private int $year;

    // 
    const MEDIA_TYPE = 'Film';

    public function __construct(string $title, int $year) {
        parent::__construct($title);
        $this->year = $year;
    }

    public function getDetails(): string {
        return "Film: '{$this->getTitle()}' ({$this->year})";
    }

    
    public function getYear(): int {
        return $this->year;
    }
}