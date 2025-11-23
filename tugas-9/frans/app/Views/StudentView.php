<?php
namespace App\Views;

use App\Models\Student;

class StudentView
{
    public function renderList(array $students): string
    {
        $out = "STUDENT LIST" . PHP_EOL;
        foreach ($students as $s) {
            $out .= (string)$s . PHP_EOL;
        }
        return $out;
    }
}
