<?php
// guestbook.php

// (Materi 10: Abstract Class)
abstract class Entry {
    protected string $name;
    protected string $message;
    protected string $date;

    // (Materi 2: Constructor)
    public function __construct(string $name, string $message) {
        $this->name = $name;
        $this->message = $message;
        $this->date = date("d-m-Y H:i:s"); // (Materi 7: Built-in function)
    }

    abstract public function format(): string; // (Materi 11: Abstract Method → Polymorphism)

    public function getDate(): string { return $this->date; }
    public function getName(): string { return $this->name; }
    public function getMessage(): string { return $this->message; }
}

// (Materi 14: Inheritance)
class Message extends Entry {
    // (Materi 11: Polymorphism → override method)
    public function format(): string {
        return "{$this->date} | {$this->name} : {$this->message}";
    }
}

class Guestbook {
    private static array $entries = []; // (Materi 6: Static Property)

    public static function addEntry(Entry $entry): void {
        self::$entries[] = $entry;
    }

    public static function getEntries(): array {
        return self::$entries;
    }
}
