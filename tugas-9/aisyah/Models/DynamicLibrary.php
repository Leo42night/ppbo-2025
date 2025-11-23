<?php
namespace PerpustakaanApp\Models;

use BadMethodCallException;

class DynamicLibrary {
    private array $data = [];
    
    public function __call(string $name, array $arguments): mixed {
        if (str_starts_with($name, 'get')) {
            $property = lcfirst(substr($name, 3));
            return $this->data[$property] ?? null;
        }
        if (str_starts_with($name, 'set')) {
            $property = lcfirst(substr($name, 3));
            $this->data[$property] = $arguments[0];
            return $this;
        }
        throw new BadMethodCallException("Method {$name} does not exist");
    }
}