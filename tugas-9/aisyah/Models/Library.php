<?php
namespace PerpustakaanApp\Models;

use IteratorAggregate;
use Countable;
use ArrayIterator;
use Traversable;

class Library implements IteratorAggregate, Countable {
    private array $items = [];
    
    public function addItem(LibraryItem $item): void {
        $this->items[$item->getId()] = $item;
    }
    
    public function getItem(string $id): ?LibraryItem {
        return $this->items[$id] ?? null;
    }
    
    public function getIterator(): Traversable {
        return new ArrayIterator($this->items);
    }
    
    public function count(): int {
        return count($this->items);
    }
    
    public function getAvailableItems(): array {
        return array_filter($this->items, fn($item) => $item->isAvailable());
    }
    
    public function getAllItems(): array {
        return $this->items;
    }
}