<?php
namespace Core;

use Models\Media;
use Interfaces\LoggerInterface;

// Menambahkan implements IteratorAggregate
final class Library implements \IteratorAggregate {
    private array $collection = [];
    private LoggerInterface $logger;

    
    public function __construct(LoggerInterface $logger) {
        $this->logger = $logger;
    }

    public function addItem(Media $item): void {
        $id = time() . rand(100, 999);
        $this->collection[$id] = $item;
    }

    public function deleteItem(string $id): void {
        if (isset($this->collection[$id])) {
            unset($this->collection[$id]);
        }
    }

    public function getCollection(): array {
        return $this->collection;
    }

    // Method wajib dari IteratorAggregate
    public function getIterator(): \ArrayIterator {
        return new \ArrayIterator($this->collection);
    }
    
    
    public function __toString(): string {
        return "Perpustakaan ini memiliki " . count($this->collection) . " item.";
    }
    
    
    public function __clone() {
        $this->logger->log("Sebuah library baru telah di-clone!");
        $this->collection = [];
    }

    // Method untuk serialization
    public function __sleep(): array {
        return ['collection'];
    }

    public function __wakeup(): void {
        $this->logger = new class implements \Interfaces\LoggerInterface {
            public function log(string $message): void { /* logger kosong */ }
        };
    }
}