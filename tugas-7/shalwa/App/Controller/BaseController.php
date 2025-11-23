<?php
namespace App\Controller;

use App\Core\Container;

abstract class BaseController
{
    public function __construct(protected Container $container) {}

    // Late static binding (6): mengembalikan instance class turunan
    public static function factory(Container $c): static
    {
        return new static($c);
    }
}
