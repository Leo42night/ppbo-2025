<?php

namespace App\Services;

use App\Models\User;
use App\Models\AbstractProduct;
use App\Traits\Logger;

// 17. Object Iteration
class Cart implements \IteratorAggregate
{
    use Logger; // 11. Trait

    private User $user;
    private array $items = [];

    // 19. Dependency Injection
    public function __construct(User $user)
    {
        $this->user = $user;
        $this->log("Keranjang dibuat untuk user: " . $this->user->getName());
    }

    public function addProduct(AbstractProduct $product, int $quantity): void
    {
        $this->items[$product->getProductID()] = ['product' => $product, 'quantity' => $quantity];
        $this->log("Produk '{$product->getName()}' ditambahkan ke keranjang.");
    }

    public function getTotal(): float
    {
        $total = 0;
        foreach ($this->items as $item) {
            $total += $item['product']->getPriceWithTax() * $item['quantity'];
        }
        return $total;
    }

    public function getIterator(): \ArrayIterator
    {
        return new \ArrayIterator($this->items);
    }

    // 16. Object Serialization (__sleep & __wakeup)
    public function __sleep(): array
    {
        return ['user', 'items']; // Tentukan properti yang akan diserialisasi
    }

    public function __wakeup(): void
    {
        $this->log("Data keranjang belanja telah dipulihkan untuk user: " . $this->user->getName());
    }
}