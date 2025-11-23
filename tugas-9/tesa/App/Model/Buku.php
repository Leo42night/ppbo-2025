<?php
namespace App\Model;
use App\Utils\Logger;

class Buku extends ItemPerpustakaan {
    use Logger;


    private $isbn;
    public static $count = 0;

    public function __construct(string $judul, string $penulis, int $tahun, string $isbn) {
        parent::__construct($judul, $penulis, $tahun);
        $this->isbn = $isbn;
        self::$count++;
    }

    public function getIsbn() {
        return $this->isbn;
    }

    public function pinjam() {
        $this->log("Meminjam buku kategori " . self::CATEGORY . ": " . $this->judul);
        echo "Judul : {$this->judul}\n";
        echo "Penulis : {$this->penulis}\n";
        echo "ISBN : {$this->isbn}\n";
        echo "Tahun : {$this->tahun}\n\n";
    }

    public function __clone() {
        $this->log("Buku '{$this->judul}' dikloning.");
    }

    public static function getCount() {
        return self::$count;
    }
}