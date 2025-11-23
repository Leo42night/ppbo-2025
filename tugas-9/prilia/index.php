<?php
require_once __DIR__ . '/AppStudentSystem.php';
use App\Models\{Course, CourseRepository, UndergraduateStudent, GraduateStudent, FilterFactory, Student, Inspector};

$studentFile = __DIR__ . '/students.dat';
$students = file_exists($studentFile) ? unserialize(file_get_contents($studentFile)) : [];

$courses = new CourseRepository();
$courses->addCourse(new Course("Aljabar Linear", 3));
$courses->addCourse(new Course("Pemrograman Komputer", 4));
$courses->addCourse(new Course("Basis Data", 3));

// === CREATE ===
if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['action'] ?? '') === 'add') {
    $type = $_POST['type'] ?? 'ug';
    $name = trim($_POST['name'] ?? '');
    $nim = trim($_POST['nim'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $phone = trim($_POST['phone'] ?? '');

    if ($name && $nim) {
        $student = $type === 'ug' ? new UndergraduateStudent($name, $nim) : new GraduateStudent($name, $nim);
        $student->setContact($email, $phone);
        foreach ($courses->getAll() as $course) {
            $key = 'grade_' . $course->getName();
            if (!empty($_POST[$key])) {
                $student->addGrade($course, (float)$_POST[$key]);
            }
        }
        $students[] = $student;
        file_put_contents($studentFile, serialize($students));
        header("Location:index.php");
        exit;
    }
}

// === DELETE ===
if (isset($_GET['delete'])) {
    $index = (int)$_GET['delete'];
    unset($students[$index]);
    $students = array_values($students);
    file_put_contents($studentFile, serialize($students));
    header("Location:index.php");
    exit;
}

// === UPDATE ===
if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['action'] ?? '') === 'edit') {
    $index = (int)$_POST['index'];
    if (isset($students[$index])) {
        $students[$index]->setName($_POST['name']);
        $students[$index]->setNim($_POST['nim']);
        $students[$index]->setContact($_POST['email'], $_POST['phone']);
        file_put_contents($studentFile, serialize($students));
        header("Location:index.php");
        exit;
    }
}

$filter = FilterFactory::createHighGPAFilter($students);
$highGPAStudents = $filter->getHighGPA(3.0);
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Sistem Mahasiswa CRUD - OOP Lanjut</title>
<style>
body{font-family:Arial;margin:30px;background:#f4f4f4;}
table{border-collapse:collapse;width:90%;margin-bottom:20px;}
th,td{border:1px solid #333;padding:8px;text-align:left;}
th{background:#007BFF;color:white;}
form{margin-bottom:20px;}
input,select{padding:5px;margin:5px;}
a.button{padding:5px 10px;background:#dc3545;color:white;text-decoration:none;border-radius:5px;}
a.button:hover{background:#b52a37;}
</style>
</head>
<body>
<h1>🎓 Sistem Informasi Mahasiswa</h1>

<h2>Tambah Mahasiswa</h2>
<form method="post" action="">
<input type="hidden" name="action" value="add">
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
</select><br>
<h3>Nilai Mata Kuliah</h3>
<?php foreach ($courses->getAll() as $course): ?>
<label><?= htmlspecialchars($course->getName()) ?>:</label>
<input type="number" name="grade_<?= htmlspecialchars($course->getName()) ?>" min="0" max="100" step="0.01"><br>
<?php endforeach; ?>
<br>
<input type="submit" value="Tambah Mahasiswa">
</form>

<h2>Daftar Mahasiswa</h2>
<table>
<tr><th>#</th><th>Nama</th><th>NIM</th><th>Email & Phone</th><th>GPA</th><th>High GPA?</th><th>Aksi</th></tr>
<?php foreach ($students as $i => $s): ?>
<tr>
<td><?= $i+1 ?></td>
<td><?= htmlspecialchars($s->getName()) ?></td>
<td><?= htmlspecialchars($s->getNim()) ?></td>
<td><?= htmlspecialchars($s->getContact()) ?></td>
<td><?= number_format($s->getGPA(), 2) ?></td>
<td><?= in_array($s, $highGPAStudents, true) ? '✅' : '❌' ?></td>
<td>
<a class="button" href="?delete=<?= $i ?>">Hapus</a>
<form method="post" style="display:inline">
<input type="hidden" name="action" value="edit">
<input type="hidden" name="index" value="<?= $i ?>">
<input type="text" name="name" value="<?= htmlspecialchars($s->getName()) ?>">
<input type="text" name="nim" value="<?= htmlspecialchars($s->getNim()) ?>">
<input type="email" name="email" value="<?= htmlspecialchars($s->getEmail()) ?>">
<input type="text" name="phone" value="<?= htmlspecialchars($s->getPhone()) ?>">
<input type="submit" value="Edit">
</form>
</td>
</tr>
<?php endforeach; ?>
</table>

<p><b>Total Mahasiswa:</b> <?= Student::getStudentCount() ?></p>
<p><b>Total GPA ≥ 3.0:</b> <?= count($highGPAStudents) ?></p>

<h3>Reflection (struktur class)</h3>
<?php if (!empty($students)) App\Models\Inspector::inspect($students[0]); ?>
</body>
</html>
