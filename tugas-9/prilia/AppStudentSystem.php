<?php
namespace App\Models;

// ==================== TRAIT ==========================
trait ContactInfo {
    private string $email = '';
    private string $phone = '';

    public function setContact(string $email, string $phone): void {
        $this->email = $email;
        $this->phone = $phone;
    }

    public function getContact(): string {
        return "Email: {$this->email}, Phone: {$this->phone}";
    }

    public function getEmail(): string { return $this->email; }
    public function getPhone(): string { return $this->phone; }

    public function __sleepTrait(): array {
        return ['email', 'phone'];
    }
}

// ==================== INTERFACE & ABSTRACT ==================
interface Gradable {
    public function addGrade(Course $course, float $grade): void;
    public function getGPA(): float;
}

abstract class Person {
    protected string $name;
    protected string $id;

    public function __construct(string $name, string $id) {
        $this->name = $name;
        $this->id = $id;
    }

    abstract public function getIdentity(): string;
}

// ==================== FINAL CLASS COURSE ==================
final class Course {
    private string $name;
    private int $credits;
    public const MAX_CREDIT = 24;

    public function __construct(string $name, int $credits) {
        $this->name = $name;
        $this->credits = $credits;
    }

    public function __toString(): string {
        return "{$this->name} ({$this->credits} SKS)";
    }

    public function getName(): string { return $this->name; }
    public function getCredits(): int { return $this->credits; }
}

// ==================== CLASS STUDENT ==================
class Student extends Person implements \IteratorAggregate, Gradable {
    use ContactInfo;

    protected array $grades = [];
    protected static int $studentCount = 0;
    public const MAX_COURSE = 6;

    public function __construct(string $name, string $nim) {
        parent::__construct($name, $nim);
        static::$studentCount++;
    }

    public function getName(): string { return $this->name; }
    public function getNim(): string { return $this->id; }
    public function setName(string $name): void { $this->name = $name; }
    public function setNim(string $nim): void { $this->id = $nim; }

    public function addGrade(Course $course, float $grade): void {
        try {
            if (count($this->grades) >= self::MAX_COURSE)
                throw new \Exception("Maksimal " . self::MAX_COURSE . " mata kuliah");
            if ($grade < 0 || $grade > 100)
                throw new \Exception("Nilai harus antara 0-100");
            $this->grades[$course->getName()] = $grade;
        } catch (\Exception $e) {
            echo "<p style='color:red'>Error: {$e->getMessage()}</p>";
        }
    }

    // Konversi nilai 0–100 menjadi skala 0–4
    public function getGPA(): float {
        return empty($this->grades) ? 0 : (array_sum($this->grades) / count($this->grades)) / 25;
    }

    public static function getStudentCount(): int {
        return static::$studentCount;
    }

    public function getIterator(): \Traversable {
        return new \ArrayIterator($this->grades);
    }

    public function __sleep(): array {
        $props = ['name', 'id', 'grades'];
        if (method_exists($this, '__sleepTrait'))
            $props = array_merge($props, $this->__sleepTrait());
        return $props;
    }

    public function __wakeup(): void {}

    public function __clone() {
        $this->grades = [];
        static::$studentCount++;
    }

    public function __get(string $prop) {
        return $this->$prop ?? null;
    }

    public function __set(string $prop, $value): void {
        if (property_exists($this, $prop))
            $this->$prop = $value;
    }

    public function __call(string $name, array $arguments) {
        return "Method {$name}() tidak ditemukan di class " . static::class;
    }

    public function __destruct() {}

    public function getIdentity(): string {
        return "{$this->name} ({$this->id})";
    }
}

// ==================== INHERITANCE ==================
class UndergraduateStudent extends Student {
    public function getGPA(): float {
        return round(parent::getGPA(), 2);
    }
}
class GraduateStudent extends Student {
    public function getGPA(): float {
        return min(round(parent::getGPA() * 1.1, 2), 4.0);
    }
}

// ==================== REPOSITORY ==================
class CourseRepository {
    private array $courses = [];
    public function addCourse(Course $course): void { $this->courses[] = $course; }
    public function getAll(): array { return $this->courses; }
}

// ==================== FILTER ANONYMOUS CLASS ==================
class FilterFactory {
    public static function createHighGPAFilter(array $students): object {
        return new class($students) {
            private array $students;
            public function __construct(array $students) { $this->students = $students; }
            public function getHighGPA(float $min = 3.0): array {
                return array_filter($this->students, fn($s) => $s->getGPA() >= $min);
            }
        };
    }
}

// ==================== REFLECTION CLASS ==================
class Inspector {
    public static function inspect($object): void {
        $ref = new \ReflectionClass($object);
        echo "<pre>Class: " . htmlspecialchars($ref->getName()) . "\nProperties:\n";
        foreach ($ref->getProperties() as $prop)
            echo " - {$prop->getName()}\n";
        echo "</pre>";
    }
}
