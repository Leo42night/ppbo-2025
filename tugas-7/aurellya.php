<?php
// =====================================================
// PHP OOP Lengkap 20 Materi - Satu File (Update TaskCollection)
// =====================================================

// ---------------------------
// 1. Namespace
// ---------------------------
namespace Aurell\OOPDemo;

// ---------------------------
// 2. Trait
// ---------------------------
trait LoggerTrait {
    public function log($msg){ echo "[LOG]: $msg<br>"; }
}

// ---------------------------
// 3. Interface & Abstract Class (Polymorphism)
// ---------------------------
interface TaskInterface {
    public function createTask($name,$desc);
    public function listTasks();
}

abstract class AbstractTask implements TaskInterface {
    protected $tasks=[];
    abstract public function taskCount();
}

// ---------------------------
// 4. TaskManager Class (Model)
// ---------------------------
class TaskManager extends AbstractTask {
    use LoggerTrait;

    public $managerName;
    protected $taskCounter=0;
    private $secretNotes=[];

    const VERSION = "1.0";
    public static $globalTaskCount = 0;

    public function __construct($name){
        $this->managerName=$name;
        $this->log("TaskManager '$name' dibuat");
    }

    public function __destruct(){
        $this->log("TaskManager '{$this->managerName}' dihancurkan");
    }

    // Encapsulation
    public function setSecretNote($note){ $this->secretNotes[]=$note; }
    public function getSecretNotes(){ return $this->secretNotes; }

    // CRUD Methods
    public function createTask($name,$desc){
        $this->taskCounter++;
        self::$globalTaskCount++;
        $id = $this->taskCounter;
        $this->tasks[$id]=['name'=>$name,'desc'=>$desc];
        $this->log("Task '$name' dibuat");
    }

    public function listTasks(){
        $html="<ul>";
        foreach($this->tasks as $id=>$task){
            $html.="<li>[ID $id] {$task['name']} - {$task['desc']} 
            <a href='?delete=$id'>Hapus</a></li>";
        }
        $html.="</ul>";
        return $html;
    }

    public function updateTask($id,$name,$desc){
        if(isset($this->tasks[$id])){
            $this->tasks[$id]=['name'=>$name,'desc'=>$desc];
            $this->log("Task ID $id diupdate");
        }
    }

    public function deleteTask($id){
        if(isset($this->tasks[$id])){
            unset($this->tasks[$id]);
            $this->log("Task ID $id dihapus");
        }
    }

    public function taskCount(){ return count($this->tasks); }

    // Magic Methods
    public function __get($name){ return $this->$name ?? "Property '$name' tidak ada"; }
    public function __set($name,$value){ $this->$name=$value; }
    public function __toString(){ return "TaskManager: {$this->managerName} dengan {$this->taskCount()} tugas"; }
    public function __call($name,$args){ echo "Method '$name' tidak ditemukan: ".implode(", ",$args)."<br>"; }

    // Serialization
    public function __sleep(){ return ['managerName','tasks']; }
    public function __wakeup(){ $this->log("TaskManager '{$this->managerName}' di-unserialize"); }

    // Static Methods
    public static function who(){ echo "TaskManager versi self ".self::VERSION."<br>"; }
    public static function whoLate(){ echo "TaskManager versi static ".static::VERSION."<br>"; }
}

// ---------------------------
// 5. AdvancedTaskManager
// ---------------------------
class AdvancedTaskManager extends TaskManager {
    const VERSION="2.0";
    final public function finalMethod(){ echo "Ini final method, tidak bisa di override<br>"; }

    public function createTask($name,$desc){
        parent::createTask($name,$desc);
        echo "AdvancedTaskManager menambahkan task dengan logging tambahan<br>";
    }
}

// ---------------------------
// 6. Dependency Injection
// ---------------------------
class User { public $username; public function __construct($username){ $this->username=$username; } }
class App { public $user; public $tm; public function __construct($user,$tm){ $this->user=$user; $this->tm=$tm; } 
    public function run(){ echo "User: {$this->user->username} sedang mengelola tugas<br>"; } 
}

// ---------------------------
// 7. Object Iteration (Fix: Tambahkan return type)
// ---------------------------
class TaskCollection implements \IteratorAggregate {
    private $tasks=[];
    public function addTask($task){ $this->tasks[]=$task; }
    public function getIterator(): \Traversable { return new \ArrayIterator($this->tasks); }
}

// ---------------------------
// 8. Anonymous Class
// ---------------------------
$anon = new class{ public function hello(){ echo "Halo dari Anonymous Class!<br>"; } };

// ---------------------------
// 9. Exception Handling
// ---------------------------
try{
    $tmTest = new TaskManager("Test");
    //$tmTest->deleteTask(999); // contoh aman
}catch (\Exception $e){ echo "Error: ".$e->getMessage(); }finally{ echo "Try-catch selesai<br>"; }

// ---------------------------
// 10. Object Serialization
// ---------------------------
$tm = new TaskManager("Kamuu");
$serialized = serialize($tm);
$tmUnserialized = unserialize($serialized);

// ---------------------------
// 11. Reflection
// ---------------------------
$reflect = new \ReflectionClass($tm);
$properties=[];
foreach($reflect->getProperties() as $prop) $properties[]=$prop->getName();

// ---------------------------
// 12. Cloning Object
// ---------------------------
$tm2 = clone $tm;
$tm2->managerName="KamuuClone";
$tm2->createTask("Clone Task","Belajar Clone");

// ---------------------------
// 13. Static Property & Method Usage
TaskManager::$globalTaskCount; TaskManager::who();

// ---------------------------
// 14. MVC sederhana
if(isset($_GET['delete'])) $tm->deleteTask($_GET['delete']);
if(isset($_POST['taskName']) && isset($_POST['taskDesc'])){
    $tm->createTask($_POST['taskName'],$_POST['taskDesc']);
}
?>

<!-- HTML View -->
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Sistem OOP 20 Materi</title>
<style>
body{font-family:sans-serif; text-align:center; background:#f0f8ff; color:#2c3e50;}
.container{max-width:700px;margin:30px auto;}
input,button{padding:10px;margin:5px;border-radius:5px;}
button{background:#1E3A8A;color:white;border:none;cursor:pointer;}
button:hover{background:#2563EB;}
.box{background:#FFFFF0;padding:20px;border-radius:15px;box-shadow:0 4px 8px rgba(0,0,0,0.1);}
</style>
</head>
<body>
<div class="container">
<h1>Selamat Datang, <?= htmlspecialchars($tm->managerName) ?></h1>
<div class="box">
<form method="post">
<input type="text" name="taskName" placeholder="Nama Task" required>
<input type="text" name="taskDesc" placeholder="Deskripsi Task" required>
<button type="submit">Tambah Task</button>
</form>

<h2>Daftar Task:</h2>
<?= $tm->listTasks() ?>

<p><strong>Properties via Reflection:</strong> <?= implode(", ",$properties) ?></p>
<p><strong>Info TaskManager:</strong> <?= $tm ?></p>
<p><?= $anon->hello() ?></p>

<?php
$app=new App(new User("Aurell"),$tm);
$app->run();
?>
</div>
</div>
</body>
</html>
