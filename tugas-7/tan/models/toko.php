<?php
namespace Models;
use Core\Logger;
use Core\Produk;

class Toko implements \IteratorAggregate {
    use Logger;
    private array $produk = [];

    public function tambahProduk(Produk $p) {
        $this->produk[] = $p;
        $this->log("Produk ditambahkan: " . $p->info());
    }

    public function getIterator(): \ArrayIterator {
        return new \ArrayIterator($this->produk);
    }
}
