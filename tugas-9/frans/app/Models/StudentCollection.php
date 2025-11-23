<?php
namespace App\Models;

class StudentCollection implements \IteratorAggregate, \Countable
{
    /** @var Student[] */
    private array $items = [];

    public function add(Student $student): void
    {
        $this->items[(string)$student->getId()] = $student;
    }

    public function remove(int|string $id): void
    {
        unset($this->items[(string)$id]);
    }

    public function get(int|string $id): Student
    {
        if (!isset($this->items[(string)$id])) {
            throw new \OutOfBoundsException("Student {$id} not found in collection");
        }
        return $this->items[(string)$id];
    }

    public function all(): array
    {
        return array_values($this->items);
    }

    public function getIterator(): \Traversable
    {
        return new \ArrayIterator($this->all());
    }

    public function count(): int
    {
        return count($this->items);
    }
}
