<?php

namespace App\Models;

class Book extends Item {
    public static int $count = 0;
    private string $title;
    private string $author;
    private ?string $isbn;

    // ... method __construct dan lainnya tetap sama ...
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
    
    // setter untuk judul agar bisa diubah saat cloning
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

    // Magic method untuk kustomisasi saat cloning
    public function __clone() {
        // Buat ID baru untuk buku hasil clone
        $this->id = uniqid("item_clone_");
        // Tambahkan "(copy)" ke judul
        $this->setTitle($this->title . " (copy)");
        // Naikkan juga total counter buku
        self::$count++; 
    }
}