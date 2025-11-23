<?php

namespace App\Models;

abstract class ItemMenu {
    protected string $id;
    protected string $nama;
    protected int $harga;

    public function __construct(string $nama, int $harga) {
        $this->id = uniqid("menu_");
        $this->nama = $nama;
        $this->harga = $harga;
    }

    public function getNama(): string {
        return $this->nama;
    }

    public function getHarga(): int {
        return $this->harga;
    }

    final public function getID(): string {
        return $this->id;
    }

    abstract public function getTipeItem(): string;
}