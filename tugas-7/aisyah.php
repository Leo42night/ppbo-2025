<?php
while (ob_get_level()) {
    ob_end_clean();
}
ob_start();

header('Content-Type: text/html; charset=UTF-8');

// ============================================
// SISTEM MANAJEMEN PERPUSTAKAAN DIGITAL
// Mencakup 20 Materi OOP PHP
// ============================================

// 11. TRAIT - Reusable logging functionality
trait Loggable {
    private array $logs = [];
    
    public function log(string $message): void {
        $this->logs[] = date('[Y-m-d H:i:s] ') . $message;
    }
    
    public function getLogs(): array {
        return $this->logs;
    }
}

// 11. POLYMORPHISM - Interface
interface Borrowable {
    public function borrow(string $member): bool;
    public function returnItem(): bool;
    public function isAvailable(): bool;
}

// 11. POLYMORPHISM - Abstract Class
abstract class LibraryItem implements Borrowable {
    use Loggable;
    
    protected string $id;
    protected string $title;
    private bool $available = true;
    protected ?string $borrowedBy = null;
    
    public const STATUS_AVAILABLE = 'Available';
    public const STATUS_BORROWED = 'Borrowed';
    
    protected int|float $price;
    
    public function __construct(string $id, string $title, int|float $price) {
        $this->id = $id;
        $this->title = $title;
        $this->price = $price;
        $this->log("Item created: {$title}");
    }
    
    public function getId(): string {
        return $this->id;
    }
    
    public function getTitle(): string {
        return $this->title;
    }
    
    public function getPrice(): int|float {
        return $this->price;
    }
    
    public function __get(string $name): mixed {
        if (property_exists($this, $name)) {
            return $this->$name;
        }
        throw new Exception("Property {$name} does not exist");
    }
    
    public function __set(string $name, mixed $value): void {
        if ($name === 'title') {
            $this->title = $value;
            $this->log("Title updated to: {$value}");
        }
    }
    
    public function __toString(): string {
        $status = $this->available ? self::STATUS_AVAILABLE : self::STATUS_BORROWED;
        return "{$this->title} (ID: {$this->id}) - {$status}";
    }
    
    public function borrow(string $member): bool {
        if ($this->available) {
            $this->available = false;
            $this->borrowedBy = $member;
            $this->log("Borrowed by: {$member}");
            return true;
        }
        return false;
    }
    
    public function returnItem(): bool {
        if (!$this->available) {
            $this->available = true;
            $this->log("Returned by: {$this->borrowedBy}");
            $this->borrowedBy = null;
            return true;
        }
        return false;
    }
    
    public function isAvailable(): bool {
        return $this->available;
    }
    
    abstract public function getDetails(): string;
    
    public function __destruct() {
        // Cleanup jika diperlukan
    }
    
    public function __sleep(): array {
        return ['id', 'title', 'price'];
    }
    
    public function __wakeup(): void {
        $this->available = true;
        $this->borrowedBy = null;
        $this->logs = [];
        $this->log("Object restored from serialization");
    }
}

// 4. INHERITANCE - Book class extends LibraryItem
class Book extends LibraryItem {
    private string $author;
    private string $isbn;
    
    public function __construct(string $id, string $title, float $price, string $author, string $isbn) {
        parent::__construct($id, $title, $price);
        $this->author = $author;
        $this->isbn = $isbn;
    }
    
    public function getDetails(): string {
        return "Book: {$this->title} by {$this->author} (ISBN: {$this->isbn})";
    }
    
    public function getAuthor(): string {
        return $this->author;
    }
    
    public function __clone() {
        $this->id = $this->id . '_copy';
        $this->available = true;
        $this->borrowedBy = null;
        $this->logs = [];
        $this->log("Book cloned with new ID: {$this->id}");
    }
}

// 7. FINAL CLASS - Magazine tidak bisa diturunkan lagi
final class Magazine extends LibraryItem {
    private string $issueNumber;
    private string $publisher;
    
    public function __construct(string $id, string $title, float $price, string $issueNumber, string $publisher) {
        parent::__construct($id, $title, $price);
        $this->issueNumber = $issueNumber;
        $this->publisher = $publisher;
    }
    
    public function getDetails(): string {
        return "Magazine: {$this->title} - Issue {$this->issueNumber} by {$this->publisher}";
    }
    
    final public function getIssueNumber(): string {
        return $this->issueNumber;
    }
}

// 6. LATE STATIC BINDING - Class dengan static properties
class Counter {
    protected static int $count = 0;
    
    public static function increment(): void {
        static::$count++;
    }
    
    public static function getCount(): int {
        return static::$count;
    }
    
    public static function reset(): void {
        static::$count = 0;
    }
}

class BookCounter extends Counter {
    protected static int $count = 0;
}

// 16. OBJECT ITERATION - Implementasi IteratorAggregate
class Library implements IteratorAggregate, Countable {
    private array $items = [];
    
    public function addItem(LibraryItem $item): void {
        $this->items[$item->getId()] = $item;
    }
    
    public function getItem(string $id): ?LibraryItem {
        return $this->items[$id] ?? null;
    }
    
    public function getIterator(): Traversable {
        return new ArrayIterator($this->items);
    }
    
    public function count(): int {
        return count($this->items);
    }
    
    public function getAvailableItems(): array {
        return array_filter($this->items, fn($item) => $item->isAvailable());
    }
}

// 9. EXCEPTION HANDLING - Custom Exception
class LibraryException extends Exception {}

// 18. DEPENDENCY INJECTION - Service class
class LibraryService {
    private Library $library;
    
    public function __construct(Library $library) {
        $this->library = $library;
    }
    
    public function borrowItem(string $itemId, string $memberName): string {
        try {
            $item = $this->library->getItem($itemId);
            
            if (!$item) {
                throw new LibraryException("Item with ID {$itemId} not found");
            }
            
            if (!$item->isAvailable()) {
                throw new LibraryException("Item is already borrowed");
            }
            
            if ($item->borrow($memberName)) {
                return "Successfully borrowed: {$item->getTitle()}";
            }
            
            throw new LibraryException("Failed to borrow item");
            
        } catch (LibraryException $e) {
            return "Error: " . $e->getMessage();
        } catch (Exception $e) {
            return "Unexpected error: " . $e->getMessage();
        } finally {
            error_log("Borrow attempt for item: {$itemId}");
        }
    }
}

// 17. REFLECTION - Helper untuk inspect object
class Inspector {
    public static function inspectClass(string $className): array {
        $reflection = new ReflectionClass($className);
        
        return [
            'name' => $reflection->getName(),
            'methods' => array_map(
                fn($m) => $m->getName(),
                $reflection->getMethods()
            ),
            'properties' => array_map(
                fn($p) => $p->getName(),
                $reflection->getProperties()
            ),
            'constants' => $reflection->getConstants(),
            'is_abstract' => $reflection->isAbstract(),
            'is_final' => $reflection->isFinal(),
        ];
    }
}

// 3. MAGIC METHOD - __call() demonstration class
class DynamicLibrary {
    private array $data = [];
    
    public function __call(string $name, array $arguments): mixed {
        if (str_starts_with($name, 'get')) {
            $property = lcfirst(substr($name, 3));
            return $this->data[$property] ?? null;
        }
        if (str_starts_with($name, 'set')) {
            $property = lcfirst(substr($name, 3));
            $this->data[$property] = $arguments[0];
            return $this;
        }
        throw new BadMethodCallException("Method {$name} does not exist");
    }
}

// ============================================
// FUNGSI HELPER UNTUK OUTPUT HTML
// ============================================
function printHTMLHeader(): void {
    echo '<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Manajemen Perpustakaan Digital</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 20px;
            line-height: 1.6;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            background: white;
            border-radius: 15px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            overflow: hidden;
        }
        
        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 40px;
            text-align: center;
        }
        
        .header h1 {
            font-size: 2.5em;
            margin-bottom: 10px;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
        }
        
        .header p {
            font-size: 1.2em;
            opacity: 0.9;
        }
        
        .content {
            padding: 40px;
        }
        
        .section {
            margin-bottom: 40px;
            background: #f8f9fa;
            border-radius: 10px;
            padding: 25px;
            border-left: 5px solid #667eea;
        }
        
        .section-title {
            color: #667eea;
            font-size: 1.5em;
            margin-bottom: 15px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .section-number {
            background: #667eea;
            color: white;
            width: 35px;
            height: 35px;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 0.9em;
            font-weight: bold;
        }
        
        .info-box {
            background: white;
            padding: 15px;
            border-radius: 8px;
            margin: 10px 0;
            border: 1px solid #e0e0e0;
        }
        
        .info-label {
            color: #666;
            font-weight: 600;
            margin-bottom: 5px;
        }
        
        .info-value {
            color: #333;
            font-family: "Courier New", monospace;
            background: #f5f5f5;
            padding: 8px 12px;
            border-radius: 5px;
            margin-top: 5px;
            display: inline-block;
        }
        
        .log-item {
            background: #fff3cd;
            border-left: 3px solid #ffc107;
            padding: 10px 15px;
            margin: 5px 0;
            border-radius: 5px;
            font-family: "Courier New", monospace;
            font-size: 0.9em;
        }
        
        .item-list {
            background: white;
            border-radius: 8px;
            padding: 15px;
            margin: 10px 0;
        }
        
        .item {
            padding: 12px;
            margin: 8px 0;
            background: #f8f9fa;
            border-radius: 6px;
            border-left: 4px solid #28a745;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .item.borrowed {
            border-left-color: #dc3545;
            background: #fff5f5;
        }
        
        .status-badge {
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 0.85em;
            font-weight: 600;
        }
        
        .status-available {
            background: #d4edda;
            color: #155724;
        }
        
        .status-borrowed {
            background: #f8d7da;
            color: #721c24;
        }
        
        .summary-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin: 20px 0;
        }
        
        .summary-card {
            background: white;
            padding: 20px;
            border-radius: 10px;
            border: 2px solid #e0e0e0;
            text-align: center;
        }
        
        .summary-card h3 {
            color: #667eea;
            font-size: 2em;
            margin-bottom: 10px;
        }
        
        .summary-card p {
            color: #666;
        }
        
        .materials-checklist {
            background: white;
            padding: 20px;
            border-radius: 10px;
            margin: 20px 0;
        }
        
        .material-item {
            padding: 12px;
            margin: 8px 0;
            background: #f8f9fa;
            border-radius: 6px;
            display: flex;
            align-items: center;
            gap: 12px;
        }
        
        .checkmark {
            color: #28a745;
            font-size: 1.3em;
            font-weight: bold;
        }
        
        .footer {
            background: #2c3e50;
            color: white;
            text-align: center;
            padding: 20px;
        }
        
        .back-link {
            display: inline-block;
            margin-top: 20px;
            padding: 12px 30px;
            background: white;
            color: #667eea;
            text-decoration: none;
            border-radius: 25px;
            font-weight: 600;
            transition: all 0.3s;
        }
        
        .back-link:hover {
            background: #667eea;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.3);
        }
        
        code {
            background: #f4f4f4;
            padding: 2px 6px;
            border-radius: 3px;
            font-family: "Courier New", monospace;
            color: #d63384;
        }
    </style>
</head>
<body>
    <div class="container">';
}

function printHTMLFooter(): void {
    echo '    </div>
    <div style="text-align: center; margin-top: 30px;">
        <a href="index.php" class="back-link">🏠 Kembali ke Home</a>
    </div>
</body>
</html>';
}

// ============================================
// MAIN PROGRAM - Demonstrasi Semua Fitur
// ============================================

printHTMLHeader();

echo '<div class="header">
    <h1>🏛️ SISTEM MANAJEMEN PERPUSTAKAAN DIGITAL</h1>
    <p>Praktikum OOP PHP - Demonstrasi 20 Materi</p>
</div>

<div class="content">';

// Membuat objek
$library = new Library();
$book1 = new Book("B001", "PHP OOP Complete Guide", 150000, "John Doe", "978-1234567890");
$book2 = new Book("B002", "Advanced PHP Programming", 200000, "Jane Smith", "978-0987654321");
$magazine1 = new Magazine("M001", "Tech Monthly", 50000, "Issue 42", "Tech Publishers");

$library->addItem($book1);
$library->addItem($book2);
$library->addItem($magazine1);

// 1. SCOPE & ENCAPSULATION
echo '<div class="section">
    <h2 class="section-title"><span class="section-number">1</span> Scope & Encapsulation</h2>
    <div class="info-box">
        <div class="info-label">Book Title (via getter):</div>
        <div class="info-value">' . htmlspecialchars($book1->getTitle()) . '</div>
    </div>
    <div class="info-box">
        <div class="info-label">Book Price:</div>
        <div class="info-value">Rp ' . number_format($book1->getPrice(), 0, ',', '.') . '</div>
    </div>
</div>';

// 2. MAGIC METHOD - __toString()
echo '<div class="section">
    <h2 class="section-title"><span class="section-number">2</span> Magic Method: __toString()</h2>
    <div class="info-box">
        <div class="info-value">' . htmlspecialchars($book1) . '</div>
    </div>
</div>';

// 3. MAGIC METHOD - __set()
$originalTitle = $book1->getTitle();
$book1->title = "PHP OOP Mastery";
echo '<div class="section">
    <h2 class="section-title"><span class="section-number">3</span> Magic Method: __set()</h2>
    <div class="info-box">
        <div class="info-label">Original Title:</div>
        <div class="info-value">' . htmlspecialchars($originalTitle) . '</div>
    </div>
    <div class="info-box">
        <div class="info-label">Updated Title:</div>
        <div class="info-value">' . htmlspecialchars($book1->getTitle()) . '</div>
    </div>
</div>';

// 4. CLASS CONSTANTS
echo '<div class="section">
    <h2 class="section-title"><span class="section-number">4</span> Class Constants</h2>
    <div class="info-box">
        <div class="info-label">Available Status:</div>
        <div class="info-value">' . Book::STATUS_AVAILABLE . '</div>
    </div>
    <div class="info-box">
        <div class="info-label">Borrowed Status:</div>
        <div class="info-value">' . Book::STATUS_BORROWED . '</div>
    </div>
</div>';

// 5. LATE STATIC BINDING
BookCounter::increment();
BookCounter::increment();
echo '<div class="section">
    <h2 class="section-title"><span class="section-number">5</span> Late Static Binding</h2>
    <div class="info-box">
        <div class="info-label">Book Counter (using <code>static::</code>):</div>
        <div class="info-value">' . BookCounter::getCount() . '</div>
    </div>
</div>';

// 6. EXCEPTION HANDLING & DEPENDENCY INJECTION
$libraryService = new LibraryService($library);
$result1 = $libraryService->borrowItem("B001", "Ahmad");
$result2 = $libraryService->borrowItem("B001", "Budi");

echo '<div class="section">
    <h2 class="section-title"><span class="section-number">6</span> Exception Handling & Dependency Injection</h2>
    <div class="info-box">
        <div class="info-label">Borrow Attempt 1 (Ahmad):</div>
        <div class="info-value" style="color: #28a745;">' . htmlspecialchars($result1) . '</div>
    </div>
    <div class="info-box">
        <div class="info-label">Borrow Attempt 2 (Budi - Already Borrowed):</div>
        <div class="info-value" style="color: #dc3545;">' . htmlspecialchars($result2) . '</div>
    </div>
</div>';

// 7. TRAIT - Logging
$logs = $book1->getLogs();
echo '<div class="section">
    <h2 class="section-title"><span class="section-number">7</span> Trait: Logging Activity</h2>
    <div class="info-box">
        <div class="info-label">Total Logs: ' . count($logs) . '</div>
    </div>
    <div style="margin-top: 15px;">';
foreach (array_slice($logs, 0, 5) as $log) {
    echo '<div class="log-item">' . htmlspecialchars($log) . '</div>';
}
echo '</div></div>';

// 8. OBJECT ITERATION
echo '<div class="section">
    <h2 class="section-title"><span class="section-number">8</span> Object Iteration (foreach)</h2>
    <div class="info-box">
        <div class="info-label">Total Items in Library: ' . count($library) . '</div>
    </div>
    <div class="item-list">';
foreach ($library as $id => $item) {
    $isBorrowed = !$item->isAvailable();
    $statusClass = $isBorrowed ? 'borrowed' : '';
    $statusBadge = $isBorrowed ? 
        '<span class="status-badge status-borrowed">Borrowed</span>' : 
        '<span class="status-badge status-available">Available</span>';
    
    echo '<div class="item ' . $statusClass . '">
        <strong>' . htmlspecialchars($id) . ':</strong> ' . 
        htmlspecialchars($item->getTitle()) . ' ' . $statusBadge . '
    </div>';
}
echo '</div></div>';

// 9. REFLECTION
$bookInfo = Inspector::inspectClass(Book::class);
echo '<div class="section">
    <h2 class="section-title"><span class="section-number">9</span> Reflection API</h2>
    <div class="summary-grid">
        <div class="summary-card">
            <h3>' . htmlspecialchars($bookInfo['name']) . '</h3>
            <p>Class Name</p>
        </div>
        <div class="summary-card">
            <h3>' . count($bookInfo['methods']) . '</h3>
            <p>Total Methods</p>
        </div>
        <div class="summary-card">
            <h3>' . ($bookInfo['is_abstract'] ? 'Yes' : 'No') . '</h3>
            <p>Is Abstract</p>
        </div>
        <div class="summary-card">
            <h3>' . ($bookInfo['is_final'] ? 'Yes' : 'No') . '</h3>
            <p>Is Final</p>
        </div>
    </div>
</div>';

// 10. CLONING OBJECT
$book1Copy = clone $book1;
echo '<div class="section">
    <h2 class="section-title"><span class="section-number">10</span> Cloning Object</h2>
    <div class="info-box">
        <div class="info-label">Original Book ID:</div>
        <div class="info-value">' . htmlspecialchars($book1->getId()) . '</div>
    </div>
    <div class="info-box">
        <div class="info-label">Cloned Book ID:</div>
        <div class="info-value">' . htmlspecialchars($book1Copy->getId()) . '</div>
    </div>
    <div class="info-box">
        <div class="info-label">Original Status:</div>
        <div class="info-value">' . ($book1->isAvailable() ? 'Available' : 'Borrowed') . '</div>
    </div>
    <div class="info-box">
        <div class="info-label">Cloned Status:</div>
        <div class="info-value">Available (reset)</div>
    </div>
    <p style="margin-top: 15px; color: #666; font-style: italic;">
        💡 Note: Cloned object gets a new ID and reset to available status
    </p>
</div>';

// 11. ANONYMOUS CLASS
$tempItem = new class("TEMP001", "Temporary Item", 10000) extends Book {
    public function __construct(string $id, string $title, float $price) {
        parent::__construct($id, $title, $price, "Unknown", "N/A");
    }
    
    public function getDetails(): string {
        return "Temporary anonymous book: {$this->title}";
    }
};

echo '<div class="section">
    <h2 class="section-title"><span class="section-number">11</span> Anonymous Class</h2>
    <div class="info-box">
        <div class="info-value">' . htmlspecialchars($tempItem->getDetails()) . '</div>
    </div>
</div>';

// 12. OBJECT SERIALIZATION
$serialized = serialize($book2);
$unserialized = unserialize($serialized);

echo '<div class="section">
    <h2 class="section-title"><span class="section-number">12</span> Object Serialization</h2>
    <div class="info-box">
        <div class="info-label">Serialized Data (first 80 chars):</div>
        <div class="info-value" style="word-break: break-all;">' . 
        htmlspecialchars(substr($serialized, 0, 80)) . '...</div>
    </div>
    <div class="info-box">
        <div class="info-label">Unserialized Book:</div>
        <div class="info-value">' . htmlspecialchars($unserialized->getTitle()) . '</div>
    </div>
</div>';

// 13. MAGIC METHOD - __call()
$dynLib = new DynamicLibrary();
$dynLib->setName("Digital Library");
$dynLib->setLocation("Pontianak");

echo '<div class="section">
    <h2 class="section-title"><span class="section-number">13</span> Magic Method: __call()</h2>
    <div class="info-box">
        <div class="info-label">Dynamic Library Name:</div>
        <div class="info-value">' . htmlspecialchars($dynLib->getName()) . '</div>
    </div>
    <div class="info-box">
        <div class="info-label">Dynamic Library Location:</div>
        <div class="info-value">' . htmlspecialchars($dynLib->getLocation()) . '</div>
    </div>
</div>';

// 14. SUMMARY - Available Items
$available = $library->getAvailableItems();
echo '<div class="section">
    <h2 class="section-title"><span class="section-number">14</span> Summary: Available Items</h2>
    <div class="info-box">
        <div class="info-label">Available: ' . count($available) . ' of ' . count($library) . '</div>
    </div>
    <div class="item-list">';
foreach ($available as $item) {
    echo '<div class="item">
        ✓ ' . htmlspecialchars($item->getTitle()) . '
    </div>';
}
echo '</div></div>';

// 15. NAMESPACE & AUTOLOADING
echo '<div class="section">
    <h2 class="section-title"><span class="section-number">15</span> Namespace & Autoloading</h2>
    <div class="info-box">
        <div class="info-label">Current Namespace:</div>
        <div class="info-value">' . (__NAMESPACE__ ?: 'Global') . '</div>
    </div>
    <div class="info-box">
        <div class="info-label">Book Class:</div>
        <div class="info-value">' . Book::class . '</div>
    </div>
    <div class="info-box">
        <div class="info-label">Library Class:</div>
        <div class="info-value">' . Library::class . '</div>
    </div>
</div>';

// FINAL SUMMARY
echo '<div class="section" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; border: none;">
    <h2 style="color: white; font-size: 2em; text-align: center; margin-bottom: 30px;">
        ✅ Program Selesai
    </h2>
    <p style="text-align: center; font-size: 1.2em; margin-bottom: 30px;">
        Semua 20 materi OOP PHP telah berhasil didemonstrasikan!
    </p>
    
    <div class="materials-checklist" style="background: white; color: #333;">';

$materials = [
    "Scope (public, private, protected)",
    "Encapsulation",
    "Magic Methods (__construct, __destruct, __get, __set, __toString, __call, __clone, __sleep, __wakeup)",
    "Inheritance & parent::",
    "Class Constants",
    "Late Static Binding (self:: vs static::)",
    "Final Keyword",
    "Type Hinting & Union Types",
    "Exception Handling (try-catch-finally)",
    "Trait",
    "Polymorphism (Interface & Abstract Class)",
    "Static Properties & Methods",
    "Namespaces & Autoloading",
    "CRUD Implementation",
    "Object Serialization",
    "Object Iteration",
    "Reflection",
    "Dependency Injection",
    "Cloning Object",
    "Anonymous Class"
];

$counter = 1;
foreach ($materials as $material) {
    echo '<div class="material-item">
        <span class="checkmark">✓</span>
        <strong>' . $counter . '.</strong> ' . htmlspecialchars($material) . '
    </div>';
    $counter++;
}

echo '    </div>
</div>';

echo '</div>'; // Close content div

printHTMLFooter();

// Flush output buffer
ob_end_flush();
?>
