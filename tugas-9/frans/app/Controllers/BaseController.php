<?php
namespace App\Controllers;

use App\Core\Contracts\Renderable;

abstract class BaseController implements Renderable
{
    abstract public function render(): string;

    public function __call(string $name, array $args): mixed
    {
        throw new \BadMethodCallException("Action {$name} not found");
    }
}
