<?php
namespace App\Model;

abstract class ItemPerpustakaan {
    public $penulis;
    protected $judul;
    protected $tahun;
    const CATEGORY = 'Umum';

    public function __construct(string $judul, string $penulis, int $tahun) {
        $this->judul = $judul;
        $this->penulis = $penulis;
        $this->tahun = $tahun;
    }

    public function penulis() {
        return $this->penulis;
    }
    public function getJudul() {
        return $this->judul;
    }
    public function getTahun() {
        return $this->tahun;
    }

    abstract public function pinjam();

    public function __toString() {
        return "{$this->judul} ({$this->tahun}) - Kategori: " . self::CATEGORY;
    }
}