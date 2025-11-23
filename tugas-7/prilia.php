<?php
namespace App\Models;

spl_autoload_register(function($class){});

trait ContactInfo {
    private string $email = '';
    private string $phone = '';

    public function setContact(string $email, string $phone) {
        $this->email = $email;
        $this->phone = $phone;
    }

    public function getContact(): string {
        return "Email: {$this->email}, Phone: {$this->phone}";
    }

    public function __sleepTrait(): array {
        return ['email','phone'];
    }
}

class Course {
    private string $name;
    private int $credits;

    public function __construct(string $name, int $credits) {
        $this->name = $name;
        $this->credits = $credits;
    }

    public function __toString(): string {
        return "{$this->name} ({$this->credits} SKS)";
    }

    public function getCredits(): int {
        return $this->credits;
    }

    public function getName(): string {
        return $this->name;
    }
}

class Student implements \IteratorAggregate {
    use ContactInfo;

    protected string $name;
    protected string $nim;
    protected array $grades = [];
    public const MAX_COURSE = 6;
    protected static int $studentCount = 0;

    public function __construct(string $name, string $nim) {
        $this->name = $name;
        $this->nim = $nim;
        self::$studentCount++;
    }

    public function addGrade(Course $course, float $grade): void {
        if (count($this->grades) >= self::MAX_COURSE) {
            throw new \Exception("Maksimal " . self::MAX_COURSE . " mata kuliah");
        }
        if ($grade < 0 || $grade > 100) {
            throw new \Exception("Nilai harus 0-100");
        }
        $this->grades[$course->getName()] = $grade;
    }

    public function getGPA(): float {
        if (empty($this->grades)) return 0;
        return array_sum($this->grades) / count($this->grades);
    }

    public static function getStudentCount(): int {
        return self::$studentCount;
    }

    public function __toString(): string {
        return "{$this->name} ({$this->nim}) - GPA: " . number_format($this->getGPA(), 2);
    }

    public function __clone() {
        $this->grades = [];
        self::$studentCount++;
    }

    public function getIterator(): \Traversable {
        return new \ArrayIterator($this->grades);
    }

    public function __sleep() {
        $props = ['name','nim','grades'];
        if(method_exists($this,'__sleepTrait')) {
            $props = array_merge($props,$this->__sleepTrait());
        }
        return $props;
    }

    public function __wakeup() {}

    public function getName(): string {
        return $this->name;
    }

    public function getNim(): string {
        return $this->nim;
    }
}

class UndergraduateStudent extends Student {
    public function getGPA(): float {
        return round(parent::getGPA(),2);
    }
}
class GraduateStudent extends Student {
    public function getGPA(): float {
        return min(round(parent::getGPA() * 1.1,2),100);
    }
}

class CourseRepository {
    private array $courses = [];

    public function addCourse(Course $course) {
        $this->courses[] = $course;
    }

    public function getAll(): array {
        return $this->courses;
    }
}

$studentFile = __DIR__.'/students.dat';
$students = [];

if(file_exists($studentFile)){
    $students = unserialize(file_get_contents($studentFile));
}

$courses = new CourseRepository();
$courses->addCourse(new Course("Aljabar Linear",3));
$courses->addCourse(new Course("Pemrograman Komputer",4));
$courses->addCourse(new Course("Basis Data",3));

if($_SERVER['REQUEST_METHOD']==='POST'){
    $type = $_POST['type'] ?? 'ug';
    $name = $_POST['name'] ?? '';
    $nim = $_POST['nim'] ?? '';
    $email = $_POST['email'] ?? '';
    $phone = $_POST['phone'] ?? '';

    if($name && $nim){
        $student = $type==='ug' ? new UndergraduateStudent($name,$nim) : new GraduateStudent($name,$nim);
        $student->setContact($email,$phone);

        foreach($courses->getAll() as $course){
            $gradeInput = $_POST['grade_'.$course->getName()] ?? '';
            $grade = (float) str_replace([','],['.'],$gradeInput);
            if($grade!==''){
                try{
                    $student->addGrade($course,$grade);
                }catch(\Exception $e){}
            }
        }

        $students[] = $student;
        file_put_contents($studentFile, serialize($students));
    }
}

$filterHighGPA = new class($students) {
    private $students;
    public function __construct($students){
        $this->students = $students;
    }
    public function getHighGPA(float $minGPA = 3.0){
        return array_filter($this->students,function($s) use ($minGPA){
            return $s->getGPA()>=$minGPA;
        });
    }
};
$highGPAStudents = $filterHighGPA->getHighGPA();
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Sistem Informasi Mahasiswa Lengkap</title>
<style>
body{font-family:Arial;margin:30px;background:#f9f9f9;}
table{border-collapse:collapse;width:90%;margin-bottom:20px;}
th,td{border:1px solid #333;padding:8px;text-align:left;}
th{background:#007BFF;color:white;}
input[type=text],input[type=number],input[type=email]{width:200px;padding:5px;margin:5px 0;}
input[type=submit]{padding:8px 15px;background:#28a745;color:white;border:none;border-radius:5px;cursor:pointer;}
input[type=submit]:hover{background:#218838;}
</style>
</head>
<body>
<h1>Sistem Informasi Mahasiswa Lengkap</h1>

<h2>Tambah Mahasiswa</h2>
<form method="post">
<label>Nama:</label><br>
<input type="text" name="name" required><br>
<label>NIM:</label><br>
<input type="text" name="nim" required><br>
<label>Email:</label><br>
<input type="email" name="email"><br>
<label>Phone:</label><br>
<input type="text" name="phone"><br>
<label>Tipe:</label><br>
<select name="type">
<option value="ug">Undergraduate</option>
<option value="grad">Graduate</option>
</select><br><br>
<h3>Input Nilai Mata Kuliah</h3>
<?php foreach($courses->getAll() as $course): ?>
<label><?= $course->getName() ?>:</label><br>
<input type="number" step="0.01" name="grade_<?= $course->getName() ?>" min="0" max="100"><br>
<?php endforeach; ?>
<br>
<input type="submit" value="Tambah Mahasiswa">
</form>

<h2>Daftar Mahasiswa</h2>
<table>
<tr>
<th>Nama</th>
<th>NIM</th>
<th>Email & Phone</th>
<th>GPA</th>
<th>High GPA?</th>
</tr>
<?php foreach($students as $s): ?>
<tr>
<td><?= htmlspecialchars($s->getName()) ?></td>
<td><?= htmlspecialchars($s->getNim()) ?></td>
<td><?= htmlspecialchars($s->getContact()) ?></td>
<td><?= number_format($s->getGPA(),2) ?></td>
<td><?= in_array($s,$highGPAStudents)?'✅':'❌' ?></td>
</tr>
<?php endforeach; ?>
</table>
<p>Total Mahasiswa: <?= Student::getStudentCount() ?></p>
<p>Total Mahasiswa GPA >= 3.0: <?= count($highGPAStudents) ?></p>
</body>
</html>
