<?php
namespace Models;
// Konsep: Inheritance (extends), parent::
class Book extends Media {
    protected string $author;
    const MEDIA_TYPE = 'Book'; // Override konstanta

    public function __construct(string $title, string $author) {
        parent::__construct($title); // Memanggil constructor parent
        $this->author = $author;
    }
    public function getDetails(): string {
        return "Buku: '{$this->title}' oleh {$this->author}";
    }
}