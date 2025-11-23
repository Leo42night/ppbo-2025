<?php
namespace App\Core;

class Container // Dependency Injection (19)
{
    /** @var array<class-string, callable> */
    private array $bindings = [];

    public function set(string $id, callable $factory): void
    {
        $this->bindings[$id] = $factory;
    }

    public function get(string $id): object
    {
        if (!isset($this->bindings[$id])) {
            throw new \RuntimeException("Service {$id} tidak terdaftar");
        }
        return ($this->bindings[$id])();
    }
}
