<?php
namespace Models;
class Movie extends Media {
    protected int $year;
    const MEDIA_TYPE = 'Movie';

    public function __construct(string $title, int $year) {
        parent::__construct($title);
        $this->year = $year;
    }
    public function getDetails(): string {
        return "Film: '{$this->title}' ({$this->year})";
    }
}