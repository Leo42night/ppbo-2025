<?php
namespace Core;

use Models\Media;
use Traits\HasTimestamp;

final class Library implements \IteratorAggregate {
    use HasTimestamp;
    private array $collection = [];

    public function __construct() {
        $this->initializeTimestamp();
    }

    public function addItem(Media $item): void {
        // ID sekarang dibuat berdasarkan timestamp agar unik
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

    public function getIterator(): \ArrayIterator {
        return new \ArrayIterator($this->collection);
    }
}