<?php
// ======================================================
// index.php
// Implementasi 20 Materi OOP PHP dalam satu file
// ======================================================

// 1. Scope (public, private, protected)
class Book {
    public $title;
    protected $author;
    private $price;
    

    // 2. Encapsulation
    public function setBook($title, $author, $price) {
        $this->title = $title;
        $this->author = $author;
        $this->price = $price;
    }
    public function getBook() {
        return "Judul: {$this->title}, Penulis: {$this->author}, Harga: {$this->price}";
    }

    // 3. Magic Methods
    public function __construct($title = "Tanpa Judul") {
        $this->title = $title;
    }
    public function __destruct() {
        echo "\nObjek Book sudah dihancurkan.";
    }
    public function __get($name) {
        return "Property {$name} tidak ada!";
    }
    public function __set($name, $value) {
        echo "\nSet {$name} dengan {$value}";
    }
    public function __toString() {
        return "Objek Buku: {$this->title}";
    }
    public function __call($method, $args) {
        return "Method {$method} tidak ditemukan!";
    }

    // 5. Class Constants
    const CATEGORY = "Literatur";

    // 12. Static Properties & Methods
    public static $totalBooks = 0;
    public static function incrementBooks() {
        self::$totalBooks++;
    }
}

// 4. Inheritance + 6. Late Static Binding + 7. Final Keyword
class Novel extends Book {
    public $genre;

    public function setGenre($genre) {
        $this->genre = $genre;
    }

    public function getBook() {
        return parent::getBook() . ", Genre: {$this->genre}";
    }

    public static function info() {
        return static::$totalBooks;
    }
}

// 8. Type Hinting & Return Types
class Library {
    private array $books = [];
    public function addBook(Book $book): void {
        $this->books[] = $book;
    }
    public function listBooks(): array {
        return $this->books;
    }
}

// 9. Exception Handling
try {
    throw new Exception("Ini contoh Exception");
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
} finally {
    echo "\nBlok finally dijalankan.";
}

// 10. Trait
trait Printable {
    public function printData() {
        echo "\nData dicetak dari Trait!";
    }
}

// 11. Polymorphism
interface Borrowable {
    public function borrow();
}
abstract class Item {
    abstract public function getInfo();
}
class Magazine extends Item implements Borrowable {
    use Printable;
    public function getInfo() {
        return "Majalah Informasi";
    }
    public function borrow() {
        return "Majalah dipinjam.";
    }
}

// 13. Namespace & Autoloading (simulasi sederhana tanpa error)
class Helper {
    public static function sayHello() {
        return "Hello dari 'simulasi' Namespace!";
    }
}
echo "\n" . Helper::sayHello();

// 14. CRUD dengan OOP
class Member {
    private $data = [];
    public function create($name) { $this->data[] = $name; }
    public function read() { return $this->data; }
    public function update($index, $name) { $this->data[$index] = $name; }
    public function delete($index) { unset($this->data[$index]); }
}

// 15. Object Serialization
$book1 = new Book("PHP Dasar");
$book1->setBook("PHP Dasar", "Andi", 50000);
$serialized = serialize($book1);
$unserialized = unserialize($serialized);

// 16. Object Iteration
class Collection implements IteratorAggregate {
    private $items = [];
    public function add($item) { $this->items[] = $item; }
    public function getIterator(): Traversable {
        return new ArrayIterator($this->items);
    }
}

// 17. Reflection
$reflect = new ReflectionClass('Book');
echo "\nNama class: " . $reflect->getName();

// 18. Dependency Injection
class Service {
    public function serve() { return "Service berjalan"; }
}
class Controller {
    private $service;
    public function __construct(Service $service) { $this->service = $service; }
    public function action() { return $this->service->serve(); }
}

// 19. Cloning Object
$book2 = clone $book1;

// 20. Anonymous Class
$anon = new class {
    public function message() { return "Saya anonymous class!"; }
};

// ======================================================
// Demonstrasi Output
// ======================================================
echo "\n-------------------------------\n";
Book::incrementBooks();
$novel = new Novel("OOP Mastery");
$novel->setBook("OOP Mastery", "Budi", 70000);
$novel->setGenre("Teknologi");
echo $novel->getBook();
echo "\nKategori: " . Book::CATEGORY;
echo "\nTotal Buku: " . Novel::info();

$library = new Library();
$library->addBook($novel);
foreach ($library->listBooks() as $b) {
    echo "\n" . $b;
}

$magazine = new Magazine();
echo "\n" . $magazine->getInfo();
echo "\n" . $magazine->borrow();
$magazine->printData();

$member = new Member();
$member->create("Ali");
$member->create("Siti");
$member->update(1, "Siti Update");
print_r($member->read());
$member->delete(0);
print_r($member->read());

echo "\nSerialized: " . $serialized;

$collection = new Collection();
$collection->add("Item 1");
$collection->add("Item 2");
foreach ($collection as $c) {
    echo "\nIterasi: " . $c;
}

$controller = new Controller(new Service());
echo "\n" . $controller->action();

echo "\n" . $anon->message();

?>
