<?php
namespace PerpustakaanApp\Models;

use PerpustakaanApp\Models\Interfaces\Borrowable;
use PerpustakaanApp\Models\Traits\Loggable;
use Exception;

abstract class LibraryItem implements Borrowable {
    use Loggable;
    
    protected string $id;
    protected string $title;
    private bool $available = true;
    protected ?string $borrowedBy = null;
    
    public const STATUS_AVAILABLE = 'Available';
    public const STATUS_BORROWED = 'Borrowed';
    
    protected int|float $price;
    
    public function __construct(string $id, string $title, int|float $price) {
        $this->id = $id;
        $this->title = $title;
        $this->price = $price;
        $this->log("Item created: {$title}");
    }
    
    public function getId(): string {
        return $this->id;
    }
    
    public function getTitle(): string {
        return $this->title;
    }
    
    public function getPrice(): int|float {
        return $this->price;
    }
    
    public function __get(string $name): mixed {
        if (property_exists($this, $name)) {
            return $this->$name;
        }
        throw new Exception("Property {$name} does not exist");
    }
    
    public function __set(string $name, mixed $value): void {
        if ($name === 'title') {
            $this->title = $value;
            $this->log("Title updated to: {$value}");
        }
    }
    
    public function __toString(): string {
        $status = $this->available ? self::STATUS_AVAILABLE : self::STATUS_BORROWED;
        return "{$this->title} (ID: {$this->id}) - {$status}";
    }
    
    public function borrow(string $member): bool {
        if ($this->available) {
            $this->available = false;
            $this->borrowedBy = $member;
            $this->log("Borrowed by: {$member}");
            return true;
        }
        return false;
    }
    
    public function returnItem(): bool {
        if (!$this->available) {
            $this->available = true;
            $this->log("Returned by: {$this->borrowedBy}");
            $this->borrowedBy = null;
            return true;
        }
        return false;
    }
    
    public function isAvailable(): bool {
        return $this->available;
    }
    
    abstract public function getDetails(): string;
    
    public function __sleep(): array {
        return ['id', 'title', 'price'];
    }
    
    public function __wakeup(): void {
        $this->available = true;
        $this->borrowedBy = null;
        $this->logs = [];
        $this->log("Object restored from serialization");
    }
}