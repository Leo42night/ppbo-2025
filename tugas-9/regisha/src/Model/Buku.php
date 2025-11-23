<?php
// 1. Scope, 2. Encapsulation, 3. Magic Methods, 5. Class Constants, 16. Object Iteration, 19. Cloning, 7. Final Function, 8. Type Hinting
namespace PerpustakaanOOP\Model;

use PerpustakaanOOP\Traits\TimestampTrait;
use IteratorAggregate;
use ArrayIterator;

// 16. Object Iteration (Implementasi IteratorAggregate)
class Buku implements IteratorAggregate {
    use TimestampTrait; // 10. Trait

    // 5. Class Constants
    public const DEFAULT_PENERBIT = "Gramedia Pustaka Utama";
    public const MAX_COPIES = 100;

    // 1. Scope: private & protected properties
    private string $judul;
    protected string $isbn; // Protected agar bisa diakses di turunannya (misal BukuFiksi)
    private string $penulis;
    private int $tahunTerbit;
    private int $jumlahStok;
    private array $dataArray; // Untuk iterasi

    // 3. Magic Method: __construct()
    public function __construct(string $judul, string $isbn, string $penulis, int $tahunTerbit, int $jumlahStok) {
        $this->judul = $judul;
        $this->isbn = $isbn;
        $this->penulis = $penulis;
        $this->tahunTerbit = $tahunTerbit;
        $this->jumlahStok = $jumlahStok;
        $this->setTimestamp(); // dari Trait
        $this->dataArray = ['judul' => $judul, 'isbn' => $isbn, 'penulis' => $penulis, 'stok' => $jumlahStok];
    }

    // 3. Magic Method: __destruct()
    public function __destruct() {
        // echo "Buku '{$this->judul}' telah dihancurkan (memori dibebaskan).\n";
    }

    // 2. Encapsulation (Method untuk mengakses/mengubah data private/protected)
    // 8. Type Hinting (string)
    public function getJudul(): string {
        return $this->judul;
    }
    public function getJumlahStok(): int {
        return $this->jumlahStok;
    }
    public function getIsbn(): string {
        return $this->isbn;
    }

    // 7. Final Function: tidak bisa di-override
    final public function tambahStok(int $jumlah): void {
        if ($this->jumlahStok + $jumlah > self::MAX_COPIES) {
            $this->jumlahStok = self::MAX_COPIES;
        } else {
            $this->jumlahStok += $jumlah;
        }
    }

    // 3. Magic Method: __get() - Mengambil data yang tidak terdefinisi (misal $buku->penerbit)
    public function __get(string $name): string|int { // 8. Return Types (Union Type)
        if ($name === 'penerbit') {
            return self::DEFAULT_PENERBIT; // 5. Class Constants
        }
        if (isset($this->$name)) {
            return $this->$name;
        }
        return "Properti '$name' tidak ditemukan";
    }

    // 3. Magic Method: __set() - Mengatur data yang tidak terdefinisi
    public function __set(string $name, $value): void {
        if ($name === 'penulis') {
            $this->penulis = $value;
        }
    }

    // 3. Magic Method: __toString()
    public function __toString(): string {
        return "Buku: {$this->judul} oleh {$this->penulis} ({$this->tahunTerbit}). Stok: {$this->jumlahStok}";
    }
    
    // 16. Object Iteration (Implementasi IteratorAggregate)
    public function getIterator(): ArrayIterator {
        return new ArrayIterator($this->dataArray);
    }
    
    // 19. Magic Method: __clone()
    public function __clone() {
        // Hapus ISBN saat cloning agar buku yang baru memiliki identitas unik
        $this->isbn = uniqid('CLONE-');
        $this->judul = "Salinan " . $this->judul;
        $this->jumlahStok = 1;
        $this->setTimestamp(); // Update waktu dibuat
    }

    // 15. Magic Method: __sleep()
    public function __sleep(): array {
        return ['judul', 'isbn', 'penulis', 'tahunTerbit', 'jumlahStok'];
    }
}

// 7. Final Keyword: final class - tidak bisa diturunkan lagi
final class BukuFiksi extends Buku {
    private string $genre;

    // 4. Inheritance: parent::
    public function __construct(string $judul, string $isbn, string $penulis, int $tahunTerbit, int $jumlahStok, string $genre) {
        parent::__construct($judul, $isbn, $penulis, $tahunTerbit, $jumlahStok);
        $this->genre = $genre;
    }

    // Override Method (Polymorphism)
    public function __toString(): string {
        // Akses protected property dari parent
        return "Buku Fiksi: " . parent::__toString() . " | Genre: {$this->genre}. (ISBN Protected: {$this->isbn})";
    }
}