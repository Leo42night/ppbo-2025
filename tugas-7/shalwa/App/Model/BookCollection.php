<?php
namespace App\Model;

use IteratorAggregate;
use ArrayIterator;

class BookCollection implements IteratorAggregate // Object iteration (16)
{
    /** @param array<int, Book> $items */
    public function __construct(private array $items) {}

    public function getIterator(): \Traversable
    {
        return new ArrayIterator($this->items);
    }
}
