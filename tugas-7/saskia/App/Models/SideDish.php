<?php

namespace App\Models;

class SideDish extends ItemMenu {
    private string $kategori;

    public function __construct(string $nama, int $harga, string $kategori) {
        parent::__construct($nama, $harga);
        $this->kategori = $kategori;
    }

    public function getTipeItem(): string {
        return $this->kategori; // Misal: "Pangsit Goreng", "Pangsit Basah"
    }
}