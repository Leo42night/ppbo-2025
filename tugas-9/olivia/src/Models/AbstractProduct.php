<?php

namespace App\Models;

// 12. Polymorphism (via Abstract Class)
abstract class AbstractProduct
{
    // 1. Scope & 2. Encapsulation
    protected int $id;
    protected string $name;
    protected float $price;
    
    // 6. Class Constants
    public const TAX = 0.11;

    // 3. Magic Method: __construct
    public function __construct(string $name, float $price)
    {
        $this->name = $name;
        $this->price = $price;
    }

    // 9. Type Hinting & Return Types
    public function getPriceWithTax(): float
    {
        return $this->price * (1 + self::TAX);
    }
    
    public function getName(): string
    {
        return $this->name;
    }
    
    public function getPrice(): float
    {
        return $this->price;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    // Method abstract yang harus diimplementasikan oleh class turunan
    abstract public function getProductType(): string;

    // 7. Late Static Binding
    public static function getTableName(): string
    {
        return 'products';
    }

    public function getStorageInfo(): string
    {
        // static:: akan merujuk pada class yang dipanggil saat runtime (Book/Electronics)
        return "Data disimpan di tabel: " . static::getTableName();
    }

    // 8. Final Keyword (Method)
    final public function getProductID(): ?int
    {
        return $this->id ?? null;
    }
}