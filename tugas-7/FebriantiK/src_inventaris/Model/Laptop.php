<?php
namespace InventoryApp\Model;

use InventoryApp\Core\Storable; // Menggunakan interface

class Laptop extends Product implements Storable {
    private int $ramSize;
    protected static string $type = 'Computer';

    public function __construct(string $name, float $price, int $ramSize) {
        parent::__construct($name, $price);
        $this->ramSize = $ramSize;
    }

    public function getInfo(): string {
        return "Laptop: {$this->name}, RAM: {$this->ramSize}GB, Harga: {$this->price}";
    }
    
    // Polymorphism: Implementasi method dari interface Storable.
    public function getStockStatus(): string {
        return "Stok untuk laptop {$this->name} tersedia.";
    }

    // Final Keyword: Method ini tidak bisa di-override oleh class turunan (jika ada).
    final public function performDiagnostics(): void {
        echo "Menjalankan diagnostik untuk {$this->name}...\n";
    }
}