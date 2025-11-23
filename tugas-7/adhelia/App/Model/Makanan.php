<?php
namespace App\Model;

use App\Model\Menu;
//inheritance menu
class Makanan extends Menu {
    public function __construct(string $nama, int $harga) {
        parent::__construct($nama, $harga, "Makanan");
    }

    //override
    public function __toString(): string {
        return "[MAKANAN] " . $this->getNama() . " - Rp" . $this->getHargaFinal();
    }
}