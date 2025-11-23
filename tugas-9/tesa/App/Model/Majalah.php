<?php
namespace App\Model;

class Majalah extends ItemPerpustakaan {
    private $isbn;

    public function __construct(string $judul, string $penulis, int $tahun, string $isbn) {
        parent::__construct($judul, $penulis, $tahun);
        $this->isbn = $isbn;
    }

    public function pinjam() {
        echo "* Majalah kategori " . self::CATEGORY . " *\n";
        echo "Judul : {$this->judul}\n";
        echo "Penulis : {$this->penulis}\n";
        echo "ISBN : {$this->isbn}\n";
        echo "Tahun : {$this->tahun}\n\n";
    }
}