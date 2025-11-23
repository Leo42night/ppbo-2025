<?php

namespace App\Interfaces;

use App\Models\AbstractProduct;

// 12. Polymorphism (via Interface)
interface Storable
{
    public function save(AbstractProduct $product): bool;
    public function findById(int $id): ?AbstractProduct;
}