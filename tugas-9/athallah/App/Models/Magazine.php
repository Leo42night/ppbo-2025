<?php

namespace App\Models;

class Magazine extends Item {
    private string $name;
    private int $issueNumber;

    public function __construct(string $name, int $issueNumber) {
        parent::__construct();
        $this->name = $name;
        $this->issueNumber = $issueNumber;
    }

    // Implementasi method abstract dari Item
    public function getSummary(): string {
        return "Majalah '{$this->name}', Edisi #{$this->issueNumber}.";
    }
}