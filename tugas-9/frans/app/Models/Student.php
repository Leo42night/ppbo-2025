<?php
namespace App\Models;

use App\Models\Traits\Timestampable;

class Student extends Entity implements \IteratorAggregate
{
    use Timestampable;

    protected static string $type = 'Student';
    protected static int $counter = 0;

    public function __construct(int|string $id, array $data = [])
    {
        parent::__construct($id, $data);
        $this->createdAt = new \DateTimeImmutable('now');
        $this->updatedAt = $this->createdAt;
        self::$counter++;
    }

    public static function count(): int
    {
        return self::$counter;
    }

    public static function typeBySelf(): string
    {
        return self::$type;
    }

    public static function typeByStatic(): string
    {
        return static::$type;
    }

    public function setAge(int|string $age): void
    {
        $this->data['age'] = is_string($age) ? (int)$age : $age;
    }

    public function getIterator(): \Traversable
    {
        return new \ArrayIterator($this->toArray());
    }

    public function toArray(): array
    {
        return ['id' => $this->getId()] + $this->data + [
            'createdAt' => $this->createdAt->format(DATE_ATOM),
            'updatedAt' => $this->updatedAt->format(DATE_ATOM),
        ];
    }

    public function __clone(): void
    {
        $this->id = $this->id . '-clone';
        $this->touch();
        self::$counter++;
    }

    public function __toString(): string
    {
        $name = $this->data['name'] ?? 'N/A';
        $email = $this->data['email'] ?? 'N/A';
        $age = $this->data['age'] ?? 'N/A';
        return "Student({$this->getId()}): {$name}, {$email}, age={$age}";
    }
}
