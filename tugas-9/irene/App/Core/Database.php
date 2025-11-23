<?php
namespace App\Core;

class Database {
    private array $data = [];

    public function insert(string $table, array $record): void {
        $this->data[$table][] = $record;
    }

    public function all(string $table): array {
        return $this->data[$table] ?? [];
    }

    public function find(string $table, callable $filter): array {
        return array_filter($this->data[$table] ?? [], $filter);
    }
}


