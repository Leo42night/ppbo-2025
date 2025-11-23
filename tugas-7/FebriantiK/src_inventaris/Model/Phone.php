<?php
namespace InventoryApp\Model;

// Inheritance: extends Product.
// Final Keyword: Class ini tidak bisa memiliki turunan lagi.
final class Phone extends Product {
    private string $os;
    protected static string $type = 'Smartphone';

    // Class Constants
    const CATEGORY = 'Mobile Devices';

    public function __construct(string $name, float $price, string $os) {
        // parent:: memanggil constructor dari parent class (Product).
        parent::__construct($name, $price);
        $this->os = $os;
    }

    // Override method abstract dari parent.
    public function getInfo(): string {
        return "HP: {$this->name}, OS: {$this->os}, Harga: {$this->price}. Kategori: " . self::CATEGORY;
    }
}