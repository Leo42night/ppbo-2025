<?php

namespace App\Models;

class Bakmie extends ItemMenu {
    private string $tipeTopping;

    public function __construct(string $nama, int $harga, string $tipeTopping) {
        parent::__construct($nama, $harga);
        $this->tipeTopping = $tipeTopping;
    }

    public function getTipeItem(): string {
        return "Bakmie";
    }
}