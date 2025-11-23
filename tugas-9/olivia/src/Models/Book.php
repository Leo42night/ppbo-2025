<?php

namespace App\Models;

// 4. Inheritance
class Book extends AbstractProduct
{
    private string $author;

    public function __construct(string $name, float $price, string $author)
    {
        // 4. Inheritance (parent::)
        parent::__construct($name, $price);
        $this->author = $author;
    }

    // 4. Inheritance (Override method)
    public function getProductType(): string
    {
        return "Buku";
    }

    public function getAuthor(): string
    {
        return $this->author;
    }

    // Override untuk Late Static Binding
    public static function getTableName(): string
    {
        return 'book_products'; // Contoh nama tabel berbeda
    }
}