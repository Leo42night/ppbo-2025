<?php

namespace App\Models;

// 4. Inheritance
class Electronics extends AbstractProduct
{
    private string $brand;

    public function __construct(string $name, float $price, string $brand)
    {
        // 4. Inheritance (parent::)
        parent::__construct($name, $price);
        $this->brand = $brand;
    }
    
    // 4. Inheritance (Override method)
    public function getProductType(): string
    {
        return "Elektronik";
    }

    public function getBrand(): string
    {
        return $this->brand;
    }
}