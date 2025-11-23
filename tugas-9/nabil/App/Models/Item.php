<?php

namespace App\Models; // Tambahkan ini

abstract class Item {
// ... isi class sama seperti sebelumnya ...
    protected $id;

    public function __construct() {
        $this->id = uniqid("item_");
    }

    final public function getIdentifier(): string {
        return $this->id;
    }

    abstract public function getSummary(): string;
}