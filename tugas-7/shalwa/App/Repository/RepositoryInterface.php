<?php
namespace App\Repository;

use App\Model\Book;

interface RepositoryInterface // Polymorphism via interface (11)
{
    /** @return array<int, Book> */
    public function all(): array;
    public function create(Book $book): Book;
    public function find(int $id): ?Book;
    public function update(Book $book): Book;
    public function delete(int $id): void;
}
