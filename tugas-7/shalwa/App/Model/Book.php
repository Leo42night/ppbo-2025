<?php

namespace App\Model;

use App\Trait\Loggable;

class Book
{
    use Loggable;

    public const TYPE = 'BOOK'; // Class constant (5)

    // Visibility (1)
    private int $id = 0;
    protected string $title;
    public string $author;

    // // Static-like typed map untuk __get/__set (2,3,8)
    // /** @var array<string, callable(self): mixed> */
    // private static array $getters = [
    //     'id' => fn(self $b) => $b->id,
    //     'title' => fn(self $b) => $b->title,
    //     'author' => fn(self $b) => $b->author,
    // ];

    // /** @var array<string, callable(self, mixed): void> */
    // private static array $setters = [
    //     'id' => fn(self $b, $v) => $b->id = (int)$v,
    //     'title' => fn(self $b, $v) => $b->title = (string)$v,
    //     'author' => fn(self $b, $v) => $b->author = (string)$v,
    // ];

    private static array $getters = [];
    private static array $setters = [];

    public static function init(): void
    {
        self::$getters = [
            'id' => function (self $b) {
                return $b->id;
            },
            'title' => function (self $b) {
                return $b->title;
            },
            'author' => function (self $b) {
                return $b->author;
            },
        ];

        self::$setters = [
            'id' => function (self $b, $v) {
                $b->id = (int)$v;
            },
            'title' => function (self $b, $v) {
                $b->title = (string)$v;
            },
            'author' => function (self $b, $v) {
                $b->author = (string)$v;
            },
        ];
    }

    public function __construct(string $title, string $author) // __construct (3)
    {
        $this->title  = $title;
        $this->author = $author;
        self::log("Constructed Book '{$title}' by {$author}");
    }

    public function __destruct() // __destruct (3)
    {
        // Tidak melakukan I/O besar; sekadar jejak
        // self::log("Destruct Book '{$this->title}'");
    }

    // Encapsulation via magic accessors (2,3)
    public function __get(string $name)
    {
        return self::$getters[$name]($this) ?? null;
    }

    public function __set(string $name, $value): void
    {
        if (isset(self::$setters[$name])) {
            self::$setters[$name]($this, $value);
            return;
        }
        throw new \InvalidArgumentException("Property {$name} tidak dapat di-set");
    }

    // __call untuk dynamic setter seperti setTitle('...')
    public function __call(string $name, array $args)
    {
        if (str_starts_with($name, 'set') && isset($args[0])) {
            $prop = lcfirst(substr($name, 3));
            $this->__set($prop, $args[0]);
            return null;
        }
        throw new \BadMethodCallException("Method {$name} tidak tersedia");
    }

    public function __toString(): string // __toString (3)
    {
        return "[Book {$this->id}] {$this->title} - {$this->author}";
    }

    public function __sleep(): array // Serialization hooks (15)
    {
        // Simpan hanya data penting
        return ['id', 'title', 'author'];
    }

    public function __wakeup(): void // Serialization hooks (15)
    {
        // Re-init ringan (contoh)
        // self::log("Book #{$this->id} woke up");
    }

    public function __clone(): void // Cloning hook (19)
    {
        $this->id = 0; // clone dianggap entitas baru
        $this->title .= ' (cloned)';
    }

    // Type hints & return types (8)
    public function setId(int $id): void
    {
        $this->id = $id;
    }
    public function getId(): int
    {
        return $this->id;
    }

    // Union type contoh (8)
    public function setAuthor(string|int $author): void
    {
        $this->author = (string)$author;
    }
}
