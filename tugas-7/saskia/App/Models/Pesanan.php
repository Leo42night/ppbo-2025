<?php

namespace App\Models;

use App\Traits\BisaDiskon;

class Pesanan {
    use BisaDiskon;

    private string $namaPesanan;
    private array $items = [];

    public function __construct(string $namaPesanan) {
        $this->namaPesanan = $namaPesanan;
    }

    public function tambahItem(ItemMenu $item): void {
        $this->items[] = $item;
    }

    public function getItems(): array {
        return $this->items;
    }
    
    public function hitungSubtotal(): int {
        $subtotal = 0;
        foreach ($this->items as $item) {
            $subtotal += $item->getHarga();
        }
        return $this->hitungHargaSetelahDiskon($subtotal);
    }
    
    public function __toString(): string {
        return "Pesanan untuk {$this->namaPesanan} (" . count($this->items) . " item)";
    }

    public function __clone() {
        $this->namaPesanan = $this->namaPesanan . " (Salinan)";
    }
}