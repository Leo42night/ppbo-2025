<?php
namespace App\Models;

class Peminjaman {
    private $namaPeminjam;
    private $item;

    public function __construct($namaPeminjam, $item) {
        $this->namaPeminjam = $namaPeminjam;
        $this->item = $item;
    }

    public function infoPinjaman() {
        return "{$this->namaPeminjam} meminjam {$this->item->getJudul()}";
    }
}
