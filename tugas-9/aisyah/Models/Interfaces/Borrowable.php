<?php
namespace PerpustakaanApp\Models\Interfaces;

interface Borrowable {
    public function borrow(string $member): bool;
    public function returnItem(): bool;
    public function isAvailable(): bool;
}
