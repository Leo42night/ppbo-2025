<?php
namespace PerpustakaanApp\Models;

class Book extends LibraryItem {
    private string $author;
    private string $isbn;
    
    public function __construct(string $id, string $title, float $price, string $author, string $isbn) {
        parent::__construct($id, $title, $price);
        $this->author = $author;
        $this->isbn = $isbn;
    }
    
    public function getDetails(): string {
        return "Book: {$this->title} by {$this->author} (ISBN: {$this->isbn})";
    }
    
    public function getAuthor(): string {
        return $this->author;
    }
    
    public function __clone() {
        $this->id = $this->id . '_copy';
        $this->available = true;
        $this->borrowedBy = null;
        $this->logs = [];
        $this->log("Book cloned with new ID: {$this->id}");
    }
}