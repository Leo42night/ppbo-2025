<?php
declare(strict_types=1);

spl_autoload_register(function (string $class): void {
    $prefix = 'App\\';
    $base_dir = __DIR__ . '/app/';
    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        return;
    }
    $relative_class = substr($class, $len);
    $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';
    if (file_exists($file)) {
        require $file;
    }
});

use App\Repositories\StudentRepository;
use App\Controllers\StudentController;
use App\Models\Student;use App\Models\HonorsStudent;
use App\Models\StudentCollection;
use App\Support\IdGenerator;
use App\Core\Exceptions\NotFoundException;
use App\Core\Exceptions\ValidationException;

$logger = new class {
    public function log(string $message): void {
        echo "[LOG] " . $message . PHP_EOL;
    }
};

$repo = new StudentRepository($logger);
$controller = new StudentController($repo);

echo "=== CREATE ===", PHP_EOL;
try {
    $s1 = $controller->create([
        'id' => IdGenerator::generate(),
        'name' => 'Andi',
        'email' => 'andi@example.com',
        'age' => 20,
    ]);
    $s2 = $controller->create([
        'id' => IdGenerator::generate(),
        'name' => 'Budi',
        'email' => 'budi@example.com',
        'age' => 22,
    ]);
} catch (ValidationException $e) {
    echo "Validation error: {$e->getMessage()}", PHP_EOL;
} finally {
    echo "(create finished)", PHP_EOL;
}

echo PHP_EOL, "=== READ ALL (ITERATION) ===", PHP_EOL;
$collection = $controller->index();
foreach ($collection as $student) {
    echo (string)$student, PHP_EOL;
}
echo PHP_EOL, "=== ITERATE SINGLE STUDENT (IteratorAggregate) ===", PHP_EOL;
foreach ($s1 as $k => $v) { echo $k . "=" . (is_scalar($v) ? $v : json_encode($v)) . PHP_EOL; }

echo PHP_EOL, "=== UPDATE ===", PHP_EOL;
try {
    $controller->update($s1->getId(), ['age' => 21]);
    echo "Updated: ", (string)$controller->show($s1->getId()), PHP_EOL;
} catch (NotFoundException $e) {
    echo "Not found: {$e->getMessage()}", PHP_EOL;
}

echo PHP_EOL, "=== LATE STATIC BINDING ===", PHP_EOL;
echo "Student self:: => " . Student::typeBySelf() . PHP_EOL;
echo "Student static:: => " . Student::typeByStatic() . PHP_EOL;
echo "HonorsStudent self:: => " . HonorsStudent::typeBySelf() . PHP_EOL;
echo "HonorsStudent static:: => " . HonorsStudent::typeByStatic() . PHP_EOL;

echo PHP_EOL, "=== __call Dynamic Finder ===", PHP_EOL;
$found = $repo->findByEmail('budi@example.com');
echo "Found by email: ", (string)$found, PHP_EOL;

echo PHP_EOL, "=== CLONE ===", PHP_EOL;
$cloned = clone $s2;
$cloned->name = 'Budi (Clone)';
echo "Original: ", (string)$s2, PHP_EOL;
echo "Cloned:   ", (string)$cloned, PHP_EOL;

echo PHP_EOL, "=== SERIALIZE / UNserialize ===", PHP_EOL;
$serialized = serialize($s1);
echo "Serialized length: ", strlen($serialized), PHP_EOL;
$un = unserialize($serialized);
echo "After wakeup: ", (string)$un, PHP_EOL;

echo PHP_EOL, "=== REFLECTION ===", PHP_EOL;
$ref = new ReflectionClass(Student::class);
echo "Class: {$ref->getName()}", PHP_EOL;
echo "Properties: ", implode(', ', array_map(fn($p) => $p->getName(), $ref->getProperties())), PHP_EOL;
echo "Methods: ", implode(', ', array_map(fn($m) => $m->getName(), $ref->getMethods())), PHP_EOL;

echo PHP_EOL, "=== DELETE ===", PHP_EOL;
try {
    $controller->delete($s2->getId());
    echo "Deleted ID {$s2->getId()}", PHP_EOL;
} catch (NotFoundException $e) {
    echo "Not found: {$e->getMessage()}", PHP_EOL;
} finally {
    echo "(delete finished)", PHP_EOL;
}

echo PHP_EOL, "=== VIEW RENDER ===", PHP_EOL;
echo $controller->render();

echo PHP_EOL, "=== FINAL METHOD DEMO ===", PHP_EOL;
echo "Entity version: " . $s1->version() . PHP_EOL;

echo PHP_EOL, "=== FINAL CLASS DEMO ===", PHP_EOL;
echo "New UUID: " . IdGenerator::generate() . PHP_EOL;

echo PHP_EOL, "=== END ===", PHP_EOL;
