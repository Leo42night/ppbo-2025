<?php
namespace Interfaces;
// Konsep: Polymorphism (Interface)
interface Loggable {
    public function log(string $message): void;
}