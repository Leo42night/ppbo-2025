<?php
namespace Models;

class Book extends Media {
    private string $author;
    
   
    const MEDIA_TYPE = 'Buku';

    public function __construct(string $title, string $author) {
        parent::__construct($title);
        $this->author = $author;
    }

    public function getDetails(): string {
        return "Buku: '{$this->getTitle()}' oleh {$this->author}";
    }

    
    public function getAuthor(): string {
        return $this->author;
    }
}