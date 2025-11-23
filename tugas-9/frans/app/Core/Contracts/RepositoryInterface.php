<?php
namespace App\Core\Contracts;

use App\Models\Student;
use App\Models\StudentCollection;

interface RepositoryInterface
{
    public function all(): StudentCollection;
    public function find(int|string $id): Student;
    public function create(Student $student): Student;
    public function update(int|string $id, array $data): Student;
    public function delete(int|string $id): void;
}
