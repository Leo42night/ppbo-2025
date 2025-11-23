<?php
declare(strict_types=1);
namespace LaundryApp\Interfaces;

use LaundryApp\Model\Service;

interface RepositoryInterface
{
    public function all(): array;
    public function find(int $id): ?Service;
    public function save(Service $service): Service;
    public function delete(int $id): bool;
}
