<?php
namespace Models;
use Core\Produk;

class Bunga extends Produk {
    public function info(): string {
        return "Bunga: {$this->nama}, Harga: Rp {$this->getHarga()}";
    }
}
