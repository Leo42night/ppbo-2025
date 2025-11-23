<?php

namespace App\Controllers;

use App\Models\Book;
use App\Services\Database;
use Exception;
use App\Controllers\Loggable;


class Library {
    use Loggable;

    const MAX_CAPACITY = 100;
    private array $collection = [];
    private Database $db;

    public function __construct(Database $db) {
        $this->db = $db;
        $this->log("Class Library telah diinisialisasi dengan koneksi database.");
    }
    
    public function addBook(Book $book): bool {
        if (count($this->collection) < self::MAX_CAPACITY) {
            $this->collection[$book->getIdentifier()] = $book;
            $this->log("Buku '{$book->getTitle()}' telah ditambahkan.");
            // Menggunakan dependensi yang disuntikkan
            $this->db->query("INSERT INTO books (title) VALUES ('{$book->getTitle()}')");
            return true;
        }
        return false;
    }

    // ... sisa method (findBookById, listAllBooks, dll.) tidak berubah ...
    public function findBookById(string $id): ?Book {
        if (!isset($this->collection[$id])) {
            throw new Exception("Buku dengan ID '{$id}' tidak ditemukan!");
        }
        return $this->collection[$id];
    }

    public function listAllBooks(): array {
        return $this->collection;
    }

    public function removeBook(string $id): bool {
        if (isset($this->collection[$id])) {
            $title = $this->collection[$id]->getTitle();
            unset($this->collection[$id]);
            $this->log("Buku '{$title}' telah dihapus.");
            return true;
        }
        return false;
    }
}