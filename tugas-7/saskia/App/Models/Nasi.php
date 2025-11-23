<?php

namespace App\Models;

class Nasi extends ItemMenu {
    private string $laukUtama;

    public function __construct(string $nama, int $harga, string $laukUtama) {
        parent::__construct($nama, $harga);
        $this->laukUtama = $laukUtama;
    }

    public function getTipeItem(): string {
        return "Nasi ({$this->laukUtama})";
    }
}