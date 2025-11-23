<?php
namespace Models;

abstract class Media {
    protected string $title;

    public function __construct(string $title) {
        $this->title = $title;

    }

    abstract public function getDetails(): string;

    public function getTitle(): string {
        return $this->title;
    }

    // METHOD __DESTRUCT JUGA DIHAPUS KARENA MENYEBABKAN OUTPUT
}