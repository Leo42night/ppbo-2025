<?php
namespace App\Core\Contracts;

interface Renderable
{
    public function render(): string;
}
