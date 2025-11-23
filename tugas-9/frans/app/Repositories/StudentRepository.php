<?php
namespace App\Repositories;

use App\Core\Contracts\RepositoryInterface;
use App\Core\Exceptions\NotFoundException;
use App\Core\Exceptions\ValidationException;
use App\Models\Student;
use App\Models\StudentCollection;

class StudentRepository implements RepositoryInterface
{
    private StudentCollection $store;
    private object $logger;

    public function __construct(object $logger)
    {
        $this->store = new StudentCollection();
        $this->logger = $logger;
    }

    public function all(): StudentCollection
    {
        return $this->store;
    }

    public function find(int|string $id): Student
    {
        foreach ($this->store as $student) {
            if ($student->getId() == $id) {
                return $student;
            }
        }
        throw new NotFoundException("Student with id {$id} not found");
    }

    public function create(Student $student): Student
    {
        $this->validate($student);
        $this->store->add($student);
        $this->log("Created student {$student->getId()}");
        return $student;
    }

    public function update(int|string $id, array $data): Student
    {
        $student = $this->find($id);
        foreach ($data as $k => $v) {
            $student->$k = $v;
        }
        $student->touch();
        $this->log("Updated student {$id}");
        return $student;
    }

    public function delete(int|string $id): void
    {
        // ensure exists
        $this->find($id);
        $this->store->remove($id);
        $this->log("Deleted student {$id}");
    }

    private function validate(Student $student): void
    {
        $email = $student->email;
        if (!is_string($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new ValidationException('Invalid email');
        }
    }

    public function __call(string $name, array $arguments): mixed
    {
        if (str_starts_with($name, 'findBy')) {
            $field = lcfirst(substr($name, 6));
            foreach ($this->store as $student) {
                if (($student->$field ?? null) === ($arguments[0] ?? null)) {
                    return $student;
                }
            }
            throw new NotFoundException("Student not found by {$field}");
        }
        throw new \BadMethodCallException("Unknown method {$name}");
    }

    private function log(string $message): void
    {
        if (method_exists($this->logger, 'log')) {
            $this->logger->log($message);
        }
    }
}
