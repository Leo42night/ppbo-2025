<?php
// classes.php
// Mencakup 20 konsep OOP + CRUD Mahasiswa (data hanya disimpan sementara)

// 1. Class & Property
class Mahasiswa
{
    public $id;
    public $nama;
    public $nim;
    public $jurusan;

    // 2. Constructor
    public function __construct($id, $nama, $nim, $jurusan)
    {
        $this->id = $id;
        $this->nama = $nama;
        $this->nim = $nim;
        $this->jurusan = $jurusan;
    }

    // 3. Method
    public function getInfo()
    {
        return "$this->nama ($this->nim) - $this->jurusan";
    }

    // 4. Destructor
    public function __destruct()
    {
        // echo "Objek Mahasiswa $this->nama dihapus<br>"; // hanya demo
    }
}

// 5. Inheritance
class MahasiswaAktif extends Mahasiswa
{
    public $status = "Aktif";
}

// 6. Polymorphism
class MahasiswaLulus extends Mahasiswa
{
    public $status = "Lulus";

    public function getInfo()
    {
        return parent::getInfo() . " - Status: $this->status";
    }
}

// 7. Encapsulation
class MahasiswaEncap
{
    private $nilai;

    public function setNilai($nilai)
    {
        if ($nilai >= 0 && $nilai <= 100) {
            $this->nilai = $nilai;
        }
    }

    public function getNilai()
    {
        return $this->nilai;
    }
}

// 8. Abstraction
abstract class Person
{
    abstract public function getRole();
}

// 9. Interface
interface RepositoryInterface
{
    public function all();
    public function find($id);
    public function add($obj);
    public function update($id, $obj);
    public function delete($id);
}

// 10. Trait
trait Logger
{
    public function log($msg)
    {
        echo "<small style='color:gray'>[LOG]: $msg</small><br>";
    }
}

// 11. Static
class Counter
{
    public static $count = 0;
    public static function increment()
    {
        return ++self::$count;
    }
}

// 12. Constant
class AppConfig
{
    const APP_NAME = "CRUD Mahasiswa OOP";
}

// 13. Visibility
class ExampleVisibility
{
    public $publicVar = "Bisa diakses";
    protected $protectedVar = "Terbatas di child";
    private $privateVar = "Hanya di class ini";
}

// 14. Overloading (magic method)
class MagicDemo
{
    private $data = [];
    public function __set($name, $value)
    {
        $this->data[$name] = $value;
    }
    public function __get($name)
    {
        return $this->data[$name] ?? null;
    }
}

// 15. Overriding → sudah ada di MahasiswaLulus

// 16. Collection Class
class MahasiswaCollection
{
    private $list = [];
    public function add(Mahasiswa $m)
    {
        $this->list[] = $m;
    }
    public function all()
    {
        return $this->list;
    }
}

// 17. Dependency Injection
class Service
{
    private $repo;
    public function __construct(RepositoryInterface $repo)
    {
        $this->repo = $repo;
    }
    public function getRepo()
    {
        return $this->repo;
    }
}

// 18. Repository Pattern (CRUD Mahasiswa sementara di memori)
class MahasiswaRepository implements RepositoryInterface
{
    use Logger;
    private $items = [];

    public function all()
    {
        return $this->items;
    }

    public function find($id)
    {
        foreach ($this->items as $m) {
            if ($m->id == $id)
                return $m;
        }
        return null;
    }

    public function add($obj)
    {
        $this->items[] = $obj;
        $this->log("Mahasiswa {$obj->nama} ditambahkan");
    }

    public function update($id, $obj)
    {
        foreach ($this->items as $key => $m) {
            if ($m->id == $id) {
                $this->items[$key] = $obj;
                $this->log("Mahasiswa ID $id diupdate");
                return true;
            }
        }
        return false;
    }

    public function delete($id)
    {
        foreach ($this->items as $key => $m) {
            if ($m->id == $id) {
                unset($this->items[$key]);
                $this->items = array_values($this->items);
                $this->log("Mahasiswa ID $id dihapus");
                return true;
            }
        }
        return false;
    }
}

// 19. Namespace (disimulasikan semua class dalam satu file)
// 20. Autoload (tidak dibuat karena semua class di 1 file ini)
