<?php

namespace App\Models;

class Book extends Item implements Displayable {
    public static int $count = 0;
    private string $title;
    private string $author;
    private ?string $isbn;

    public function __construct(string $title, string $author, ?string $isbn = null) {
        parent::__construct();
        $this->title = $title;
        $this->author = $author;
        $this->isbn = $isbn;
        self::$count++;
    }

    public function getTitle(): string {
        return $this->title;
    }

    public function getAuthor(): string {
        return $this->author;
    }
    
    public function setTitle(string $title): void {
        $this->title = $title;
    }

    public function getSummary(): string {
        return "Buku berjudul '{$this->title}' oleh {$this->author}.";
    }

    public static function getTotalBooks(): int {
        return self::$count;
    }

    public function __toString(): string {
        $isbnText = $this->isbn ? " (ISBN: {$this->isbn})" : "";
        return "[Book ID: {$this->id}] {$this->title} oleh {$this->author}{$isbnText}.";
    }

    public function __clone() {
        $this->id = uniqid("item_clone_");
        $this->setTitle($this->title . " (copy)");
        self::$count++; 
    }

    // Method baru dari interface Displayable
    public function getDisplayHtml(): string {
        return "<h4>" . htmlspecialchars($this->title) . "</h4><p>Oleh: " . htmlspecialchars($this->author) . "</p>";
    }
}