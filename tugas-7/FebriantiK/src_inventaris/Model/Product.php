<?php
namespace InventoryApp\Model;

// Inheritance: Class abstract sebagai parent.
abstract class Product {
    // Scope & Encapsulation: Properti protected hanya bisa diakses oleh class ini dan turunannya.
    protected string $name;
    protected float $price;
    protected static string $type = 'General Product';

    // Type Hinting & Return Types
    public function __construct(string $name, float $price) {
        $this->name = $name;
        $this->price = $price;
    }

    public function getName(): string {
        return $this->name;
    }

    // Abstract method harus diimplementasikan oleh child class.
    abstract public function getInfo(): string;

    // Late Static Binding: static:: merujuk pada class yang dipanggil saat runtime.
    public static function getProductType(): string {
        return "Tipe Produk: " . static::$type;
    }
}