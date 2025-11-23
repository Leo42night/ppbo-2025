<?php
namespace App\Models;

abstract class Entity implements \Stringable
{
    protected int|string $id;
    protected array $data = [];

    public const STATUS_ACTIVE = 'active';
    public const STATUS_INACTIVE = 'inactive';

    final public function getId(): int|string
    {
        return $this->id;
    }

    final public function version(): string
    {
        return '1.0.0';
    }

    public function __construct(int|string $id, array $data = [])
    {
        $this->id = $id;
        $this->data = $data;
    }

    public function __get(string $name): mixed
    {
        return $this->data[$name] ?? null;
    }

    public function __set(string $name, mixed $value): void
    {
        $this->data[$name] = $value;
    }

    public function __toString(): string
    {
        return static::class . " #{$this->id}";
    }

    public function __call(string $name, array $arguments): mixed
    {
        if (str_starts_with($name, 'get')) {
            $key = lcfirst(substr($name, 3));
            return $this->data[$key] ?? null;
        }
        throw new \BadMethodCallException("Method {$name} does not exist");
    }

    public function __sleep(): array
    {
        return ['id', 'data'];
    }

    public function __wakeup(): void
    {
        // No-op; could restore resources
    }

    public function __destruct()
    {
        // For demo; generally avoid heavy work here
    }
}
