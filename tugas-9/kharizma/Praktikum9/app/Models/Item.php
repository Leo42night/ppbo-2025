<?php
namespace App\Models;

abstract class Item {
    protected $judul;
    protected $pengarang;
    protected $tahun;

    public function __construct($judul, $pengarang, $tahun) {
        $this->judul = $judul;
        $this->pengarang = $pengarang;
        $this->tahun = $tahun;
    }

    abstract public function getInfo();

    public function getJudul() {
        return $this->judul;
    }
}
