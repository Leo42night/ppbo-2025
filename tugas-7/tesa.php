<?php
namespace Perpustakaan\Model;

// Abstract class dengan Encapsulation dan Scope private/protected
abstract class ItemPerpustakaan {
    public $penulis;
    protected $judul;
    protected $tahun;
    const CATEGORY = 'Umum';

    public function __construct(string $judul, string $penulis, int $tahun) {
        $this->judul = $judul;
        $this->penulis = $penulis;
        $this->tahun = $tahun;
    }

    // Getter dengan encapsulation
    public function penulis() {
        return $this->penulis;
    }
    public function getJudul() {
        return $this->judul;
    }
    public function getTahun() {
        return $this->tahun;
    }

    // Abstract method – Polymorphism
    abstract public function pinjam();

    // Magic method __toString
    public function __toString() {
        return "{$this->judul} ({$this->tahun})";
    }
}

namespace Perpustakaan\Utils;
trait Logger {
    public function log(string $msg) {
        echo "<p class='log'>[LOG] $msg</p>";
    }
}

namespace Perpustakaan\Model;
use Perpustakaan\Utils\Logger;

class Buku extends ItemPerpustakaan {
    use Logger;

    private $isbn;
    public static $count = 0;

    public function __construct(string $judul, string $penulis, int $tahun, string $isbn) {
        parent::__construct($judul, $penulis, $tahun);
        $this->isbn = $isbn;
        self::$count++;
    }

    public function getIsbn() {
        return $this->isbn;
    }

    public function pinjam() {
        echo "<div class='item'>";
        $this->log("Meminjam buku: " . $this->getJudul());
        echo "<h3 class='judul'>Buku yang dipinjam:</h3>";
        echo "<p><strong>Judul:</strong> " . htmlspecialchars($this->getJudul()) . "</p>";
        echo "<p><strong>Penulis:</strong> " . htmlspecialchars($this->penulis()) . "</p>";
        echo "<p><strong>ISBN:</strong> " . htmlspecialchars($this->isbn) . "</p>";
        echo "<p><strong>Tahun terbit:</strong> " . htmlspecialchars($this->getTahun()) . "</p>";
        echo "</div>";
    }

    public function __clone() {
        echo "<p class='log'>Buku '" . htmlspecialchars($this->getJudul()) . "' berhasil dikloning.</p>";
    }

    public static function getCount() {
        return self::$count;
    }
}

class Majalah extends ItemPerpustakaan {
    private $isbn;

    public function __construct(string $judul, string $penulis, int $tahun, string $isbn) {
        parent::__construct($judul, $penulis, $tahun);
        $this->isbn = $isbn;
    }

    public function pinjam() {
        echo "<div class='item majalah'>";
        echo "<h3 class='judul'>Majalah yang dipinjam:</h3>";
        echo "<p><strong>Judul:</strong> " . htmlspecialchars($this->getJudul()) . "</p>";
        echo "<p><strong>Penulis:</strong> " . htmlspecialchars($this->penulis()) . "</p>";
        echo "<p><strong>ISBN:</strong> " . htmlspecialchars($this->isbn) . "</p>";
        echo "<p><strong>Tahun terbit:</strong> " . htmlspecialchars($this->getTahun()) . "</p>";
        echo "</div>";
    }
}

namespace Perpustakaan\Controller;
use Perpustakaan\Model\ItemPerpustakaan;
use Exception;

class PerpustakaanController {
    public $items = [];

    public function tambahItem(ItemPerpustakaan $item) {
        if (!$item) {
            throw new Exception("Item tidak valid");
        }
        $this->items[] = $item;
    }

    public function pinjamSemua() {
        foreach ($this->items as $item) {
            $item->pinjam();
        }
    }

    public function simpanItems(): string {
        try {
            return serialize($this->items);
        } catch (Exception $e) {
            throw new Exception("Gagal serialisasi: " . $e->getMessage());
        }
    }

    public function muatItems(string $data) {
        $this->items = unserialize($data);
    }
}

namespace Perpustakaan\Utils;
use ReflectionClass;

class Reflector {
    public static function refleksi($obj) {
        $class = new ReflectionClass($obj);
        echo "<strong style='color:#2980b9;'>Refleksi kelas:</strong> " . htmlspecialchars($class->getName()) . "<br>";
        echo "<strong style='color:#2980b9;'>Properti:</strong><ul>";
        foreach ($class->getProperties() as $prop) {
            echo "<li>" . htmlspecialchars($prop->getName()) . "</li>";
        }
        echo "</ul>";
    }
}

namespace Perpustakaan\Service;
use Perpustakaan\Controller\PerpustakaanController;
use Perpustakaan\Model\Buku;

class PerpustakaanService {
    private $controller;

    public function __construct(PerpustakaanController $controller) {
        $this->controller = $controller;
    }

    public function tambahSampleItems() {
        $this->controller->tambahItem(new Buku("Seporsi Mie Ayam", "Brian Khrisna Penerbit",2025, "12345ABC"));
        $this->controller->tambahItem(new Buku("Laut Bercerita", "Leila S. Chudori",2017, "66958DDC"));
        $this->controller->tambahItem(new Buku("Harry Potter", "J. K. Rowling",1997, "88957WRT"));
        $this->controller->tambahItem(new \Perpustakaan\Model\Majalah("Teknologi Terkini", "Yayes",2023, "98765XYZ"));
    }
}

namespace Perpustakaan\Model;
final class LibraryInfo {
    public static $namaPerpustakaan = "Perpustakaan FMIPA";

    public static function info() {
        echo "<p style='font-weight:bold; color:#8e44ad;'>Nama Perpustakaan: " . htmlspecialchars(self::$namaPerpustakaan) . "</p>";
    }
}

namespace Perpustakaan;

use Perpustakaan\Controller\PerpustakaanController;
use Perpustakaan\Service\PerpustakaanService;
use Perpustakaan\Utils\Reflector;
use Perpustakaan\Model\Buku;

class App {
    public function run() {
        header('Content-Type: text/html; charset=utf-8');

        echo '<!DOCTYPE html><html lang="id"><head><meta charset="UTF-8"><title>Perpustakaan FMIPA</title>
<style>
    body {
        font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
        margin: 0;
        min-height: 100vh;
        background: linear-gradient(120deg, #d0e8f2, #90caf9);
        color: #2c3e50;

        display: flex;
        justify-content: center;
        align-items: center;
        padding: 2em;
        box-sizing: border-box;
    }
    .container {
        width: 90%;
        max-width: 900px;
        background: rgba(255,255,255,0.9);
        border-radius: 10px;
        padding: 2em;
        box-shadow: 0 8px 16px rgba(0,0,0,0.1);
        overflow: auto;
        box-sizing: border-box;
    }
    h1 {
        color: #1565c0;
        border-bottom: 3px solid #1565c0;
        padding-bottom: 0.3em;
    }
    h2 {
        color: #7b1fa2;
        margin-top: 2em;
        border-bottom: 2px solid #7b1fa2;
        padding-bottom: 0.2em;
    }
    .log {
        color: #2e7d32;
        font-weight: 600;
        margin-bottom: 0.5em;
        font-family: Consolas, monospace;
    }
    .item {
        background: #ffffffcc;
        padding: 1em;
        border-radius: 8px;
        margin-bottom: 1.2em;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        transition: transform 0.2s ease-in-out;
    }
    .item:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 16px rgba(0,0,0,0.15);
    }
    .majalah {
        background: #fff3e0cc;
        border-left: 6px solid #fb8c00;
    }
    .judul {
        color: #424242;
        margin-top: 0;
        font-size: 1.2em;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }
    ul {
        color: #2980b9;
        font-weight: 600;
        padding-left: 1.5em;
    }
    p {
        line-height: 1.5;
    }
</style>
</head><body><div class="container">';


        $controller = new PerpustakaanController();
        $service = new PerpustakaanService($controller);

        $service->tambahSampleItems();

        echo '<h1>Perpustakaan FMIPA</h1>';
        echo '<h2>Daftar item yang dipinjam:</h2>';
        $controller->pinjamSemua();

        echo '<h2>Reflection pada objek Buku:</h2>';
        Reflector::refleksi(new Buku("Seporsi Mie Ayam", "Brian Khrisna Penerbit",2025, "12345ABC"));

        echo '<h2>Cloning Object:</h2>';
        $cloner = new class {
            public function kloning(Buku $buku) {
                return clone $buku;
            }
        };
        $asli = new Buku("Seporsi Mie Ayam", "Brian Khrisna Penerbit",2025, "12345ABC");
        $clone = $cloner->kloning($asli);
        echo "<p><strong>Buku Asli:</strong> " . htmlspecialchars((string)$asli) . "</p>";
        echo "<p><strong>Buku Clone:</strong> " . htmlspecialchars((string)$clone) . "</p>";
        echo \Perpustakaan\Model\LibraryInfo::info();
        echo '<h2>Total Buku yang dibuat:</h2>'."<p style='font-weight:bold; color:#d84315; font-size:1.2em;'>". Buku::getCount() . "</p>";
        echo '</body></html>';
    }
}

$app = new App();
$app->run();
?>
