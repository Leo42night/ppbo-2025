<?php
namespace InventoryApp\Service;

use InventoryApp\Model\Product;
use InventoryApp\Exception\InventoryException;
use InventoryApp\Core\Logger;
use Traversable;

// Class ini mencakup banyak konsep: DI, Magic Methods, Static, Iteration, Serialization, dll.
class Warehouse implements \IteratorAggregate {
    use Logger; // Menggunakan Trait

    // Encapsulation: Properti private.
    private array $products = [];
    private string $location;

    // Static Properties
    private static int $totalWarehouses = 0;

    // Dependency Injection: Menerima object Notifier saat dibuat.
    public function __construct(string $location, private object $notifier) {
        $this->location = $location;
        self::$totalWarehouses++;
        $this->log("Gudang di {$this->location} dibuat.");
    }

    // CRUD Sederhana (Create)
    public function addProduct(Product $product): void {
        $this->products[$product->getName()] = $product;
        $this->log("Produk '{$product->getName()}' ditambahkan ke gudang {$this->location}.");
    }
    
    // CRUD Sederhana (Read)
    public function findProduct(string $name): ?Product {
        return $this->products[$name] ?? null;
    }
    
    // CRUD Sederhana (Delete)
    public function removeProduct(string $name): void {
        if (!isset($this->products[$name])) {
            throw new InventoryException("Produk '$name' tidak ditemukan untuk dihapus.");
        }
        unset($this->products[$name]);
        $this->log("Produk '$name' dihapus.");
    }

    // Static Methods
    public static function getTotalWarehouses(): int {
        return self::$totalWarehouses;
    }

    // Magic Methods
    public function __toString(): string {
        return "Gudang di {$this->location} memiliki " . count($this->products) . " jenis produk.";
    }

    public function __get(string $name) {
        if ($name === 'location') return $this->location;
        return "Properti tidak ditemukan";
    }

    public function __set(string $name, $value) {
        if ($name === 'location' && is_string($value)) {
            $this->location = $value;
        }
    }

    public function __call(string $name, array $arguments) {
        if ($name === 'notifyAdmins') {
            $message = $arguments[0] ?? 'Pemberitahuan Gudang';
            $this->notifier->send($message);
        }
    }
    
    // Object Serialization
    public function __sleep(): array {
        return ['products', 'location'];
    }

    public function __wakeup(): void {
        // Re-inject dependency after unserialize, as it's not saved.
        $this->notifier = new class { public function send(string $msg){ echo "[ANONYMOUS WAKEUP] {$msg}\n"; } };
        $this->log("Gudang di {$this->location} dipulihkan.");
    }
    
    // Object Iteration
    public function getIterator(): Traversable {
        return new \ArrayIterator($this->products);
    }
    
    // Cloning Object
    public function __clone() {
        $this->location = $this->location . " (Cabang)";
        // Deep copy products to avoid referencing the same objects
        foreach ($this->products as $key => $product) {
            $this->products[$key] = clone $product;
        }
    }
}