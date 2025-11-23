<?php
// ======================================================
// Praktikum 7 - Implementasi 20 Materi OOP PHP
// Versi lain (tema: Manajemen Film & User)
// ======================================================

// 1. Scope: public, private, protected
class Film {
    public string $judul;
    protected string $sutradara;
    private int $tahun;

    // 2. Encapsulation
    public function setData(string $judul, string $sutradara, int $tahun): void {
        $this->judul = $judul;
        $this->sutradara = $sutradara;
        $this->tahun = $tahun;
    }
    public function getInfo(): string {
        return "{$this->judul} ({$this->tahun}), oleh {$this->sutradara}";
    }

    // 3. Magic Methods
    public function __construct(string $judul = "Tanpa Judul") {
        $this->judul = $judul;
    }
    public function __destruct() {
        echo "<br><i>Objek Film {$this->judul} dihapus...</i>";
    }
    public function __get($name) {
        return "Property <b>{$name}</b> tidak ditemukan!";
    }
    public function __set($name, $value) {
        echo "<br>Mengisi properti {$name} dengan {$value}";
    }
    public function __toString(): string {
        return "Objek Film: {$this->judul}";
    }
    public function __call($name, $args) {
        return "Method {$name} tidak tersedia!";
    }

    // 5. Class Constants
    public const KATEGORI = "Film Bioskop";

    // 12. Static
    public static int $totalFilm = 0;
    public static function tambahFilm() {
        self::$totalFilm++;
    }
}

// 4. Inheritance + 6. Late Static Binding + 7. Final
class ActionFilm extends Film {
    public string $rating;
    public function setRating(string $rating): void {
        $this->rating = $rating;
    }
    public function getInfo(): string {
        return parent::getInfo() . " | Rating: {$this->rating}";
    }
    public static function total() {
        return static::$totalFilm;
    }
}
final class Dokumenter extends Film {}

// 8. Type Hinting & Return Types
class Koleksi {
    private array $film = [];
    public function tambah(Film $f): void { $this->film[] = $f; }
    public function semua(): array { return $this->film; }
}

// 9. Exception Handling
try {
    $x = 0;
    if ($x === 0) throw new Exception("Pembagian dengan nol!");
    echo 10/$x;
} catch(Exception $e) {
    echo "<br>Error: ".$e->getMessage();
} finally {
    echo "<br>Blok finally dijalankan.";
}

// 10. Trait
trait Loggable {
    public function log(string $pesan) {
        echo "<br>[LOG] {$pesan}";
    }
}

// 11. Polymorphism
interface DapatDipinjam {
    public function pinjam(): string;
}
abstract class Media {
    abstract public function deskripsi(): string;
}
class Majalah extends Media implements DapatDipinjam {
    use Loggable;
    public function deskripsi(): string { return "Majalah mingguan"; }
    public function pinjam(): string { return "Majalah dipinjam"; }
}

// 13. Namespace & Autoload (simulasi)
class Util {
    public static function greet() { return "Halo dari Util!"; }
}
echo "<br>".Util::greet();

// 14. CRUD
class User {
    private array $data = [];
    public function create(string $nama) { $this->data[] = $nama; }
    public function read(): array { return $this->data; }
    public function update(int $i, string $nama) { if(isset($this->data[$i])) $this->data[$i] = $nama; }
    public function delete(int $i) { unset($this->data[$i]); }
}

// 15. Serialization
$f1 = new Film("Interstellar");
$f1->setData("Interstellar","Christopher Nolan",2014);
$ser = serialize($f1);
$uns = unserialize($ser);

// 16. Iteration
class Playlist implements IteratorAggregate {
    private array $items=[];
    public function add($item){ $this->items[]=$item; }
    public function getIterator(): Traversable { return new ArrayIterator($this->items); }
}

// 17. Reflection
$ref = new ReflectionClass("Film");
echo "<br>Nama class: ".$ref->getName();

// 18. Dependency Injection
class Service {
    public function jalan(): string { return "Service aktif"; }
}
class Handler {
    private Service $service;
    public function __construct(Service $s){ $this->service=$s; }
    public function run(): string { return $this->service->jalan(); }
}

// 19. Cloning
$f2 = clone $f1;

// 20. Anonymous Class
$anon = new class {
    public function pesan() { return "Saya kelas anonim"; }
};

// ======================================================
// Demo Output
// ======================================================
echo "<hr>";
Film::tambahFilm();
$filmA = new ActionFilm("Matrix");
$filmA->setData("Matrix","Wachowski",1999);
$filmA->setRating("R");
echo $filmA->getInfo();
echo "<br>Kategori: ".Film::KATEGORI;
echo "<br>Total Film: ".ActionFilm::total();

$koleksi = new Koleksi();
$koleksi->tambah($filmA);
foreach($koleksi->semua() as $f){
    echo "<br>".$f;
}

$m = new Majalah();
echo "<br>".$m->deskripsi();
echo "<br>".$m->pinjam();
$m->log("Majalah baru dipinjam");

$u = new User();
$u->create("Ali");
$u->create("Budi");
print_r($u->read());
$u->update(1,"Budi Update");
$u->delete(0);
print_r($u->read());

echo "<br>Serialized: ".$ser;

$pl = new Playlist();
$pl->add("Lagu A");
$pl->add("Lagu B");
foreach($pl as $lagu){
    echo "<br>Playlist: ".$lagu;
}

$h = new Handler(new Service());
echo "<br>".$h->run();

echo "<br>".$anon->pesan();

?>
