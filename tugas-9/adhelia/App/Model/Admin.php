<?php
namespace App\Model;

final class Admin {
    private string $nama;

    public function __construct(string $nama) {
        $this->nama = $nama;
    }

    final public function getRole(): string {
        return "Admin: {$this->nama}";
    }
}
