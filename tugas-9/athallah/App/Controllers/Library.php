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
            $this->db->query("INSERT INTO books (title) VALUES ('{$book->getTitle()}')");
            return true;
        }
        return false;
    }

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

    /**
     * Magic method yang dipanggil sebelum serialize().
     * Mengembalikan array nama properti yang ingin disimpan.
     * Kita tidak ingin menyimpan koneksi database ($db).
     */
    public function __sleep(): array {
        echo "<p style='color: purple;'>[MAGIC]: __sleep() dipanggil. Hanya menyimpan 'collection'.</p>";
        return ['collection'];
    }

    /**
     * Magic method yang dipanggil setelah unserialize().
     * Berguna untuk menginisialisasi ulang resource, seperti koneksi DB.
     */
    public function __wakeup(): void {
        echo "<p style='color: purple;'>[MAGIC]: __wakeup() dipanggil. Membuat ulang koneksi database.</p>";
        $this->db = new Database();
    }
}