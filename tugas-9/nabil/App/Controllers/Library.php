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
     * Magic method yang dipanggil SEBELUM objek diserialisasi.
     * Kita hanya menyimpan data buku (collection), koneksi database (db) diabaikan.
     */
    public function __sleep(): array
    {
        echo "<p style='color: orange;'>[SLEEP]: Menyiapkan objek Library untuk disimpan. Koneksi database akan dilepaskan.</p>";
        return ['collection'];
    }

    /**
     * Magic method yang dipanggil SETELAH objek dipulihkan.
     * Kita membuat ulang koneksi database yang tadinya hilang.
     */
    public function __wakeup(): void
    {
        // Karena kita tidak menyimpan Database, kita harus membuat instance baru di sini.
        $this->db = new Database(); 
        echo "<p style='color: orange;'>[WAKEUP]: Objek Library telah dipulihkan. Koneksi database baru telah dibuat.</p>";
        $this->log("Objek Library berhasil dibangunkan dari serialization.");
    }
}