<?php
namespace App\Model;

use App\Model\Menu;
//inheritance menu
class Minuman extends Menu {
    public function __construct(string $nama, int $harga) {
        parent::__construct($nama, $harga, "Minuman");
    }
    //override method __toString()
    public function __toString(): string {
        return "[MINUMAN] " . $this->getNama() . " - Rp" . $this->getHargaFinal();
    }
}