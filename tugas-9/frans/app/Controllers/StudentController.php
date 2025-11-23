<?php
namespace App\Controllers;

use App\Repositories\StudentRepository;
use App\Models\Student;
use App\Models\StudentCollection;
use App\Views\StudentView;

class StudentController extends BaseController
{
    protected StudentRepository $repo;
    protected StudentView $view;

    public function __construct(StudentRepository $repo)
    {
        $this->repo = $repo;
        $this->view = new StudentView();
    }

    public function index(): StudentCollection
    {
        return $this->repo->all();
    }

    public function show(int|string $id): Student
    {
        return $this->repo->find($id);
    }

    public function create(array $data): Student
    {
        $student = new Student($data['id'], [
            'name' => $data['name'] ?? '',
            'email' => $data['email'] ?? '',
            'age' => $data['age'] ?? 0,
        ]);
        return $this->repo->create($student);
    }

    public function update(int|string $id, array $data): Student
    {
        return $this->repo->update($id, $data);
    }

    public function delete(int|string $id): void
    {
        $this->repo->delete($id);
    }

    public function render(): string
    {
        return $this->view->renderList($this->repo->all()->all());
    }
}
