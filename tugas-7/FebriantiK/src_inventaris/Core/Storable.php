<?php
namespace InventoryApp\Core;

// Polymorphism: Interface mendefinisikan "kontrak" method.
interface Storable {
    public function getStockStatus(): string;
}