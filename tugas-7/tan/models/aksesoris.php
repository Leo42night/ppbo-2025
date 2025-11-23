<?php
namespace Models;
use Core\Produk;

class Aksesoris extends Produk {
    public function info(): string {
        return "Aksesoris: {$this->nama}, Harga: Rp {$this->getHarga()}";
    }
}
