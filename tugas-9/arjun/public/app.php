<?php
require_once __DIR__ . '/../autoload.php';
session_start();

use Models\Book;
use Models\Movie;
use Core\Library;
use Interfaces\LoggerInterface;
use Models\Media;

// =================================================================
// CONTROLLER
// =================================================================

$logger = new class implements LoggerInterface {
    public function log(string $message): void { /* Logika bisa ditambahkan di sini */ }
};

if (!isset($_SESSION['library'])) {
    $_SESSION['library'] = new Library($logger);
}
$library = $_SESSION['library'];

// Fungsi untuk demonstrasi Polimorfisme
function cetakDetailMedia(Media $media): string {
    $details = htmlspecialchars($media->getDetails());
    $class = get_class($media);
    if (defined($class . '::MEDIA_TYPE')) {
        $type = constant($class . '::MEDIA_TYPE');
    } else {
        $type = 'Unknown';
    }
    return $details . " | Tipe: " . htmlspecialchars($type);
}
// Logika Tambah Item dengan Notifikasi
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    $title = htmlspecialchars($_POST['title']);
    if ($_POST['type'] === 'book' && !empty($_POST['author'])) {
        $library->addItem(new Book($title, htmlspecialchars($_POST['author'])));
        $_SESSION['message'] = "Buku '{$title}' berhasil ditambahkan!";
    } elseif ($_POST['type'] === 'movie' && !empty($_POST['year'])) {
        $library->addItem(new Movie($title, (int)$_POST['year']));
        $_SESSION['message'] = "Film '{$title}' berhasil ditambahkan!";
    }
    header("Location: app.php");
    exit;
}

// Logika Hapus Item dengan Notifikasi
if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id'])) {
    $library->deleteItem($_GET['id']);
    $_SESSION['message'] = "Item berhasil dihapus!";
    header("Location: app.php");
    exit;
}

// =================================================================
// VIEW
// =================================================================
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Perpustakaan Digital - Revisi</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        :root { --primary-color: #0abfbc; --secondary-color: #2c2c54; --background-color: #1a1a2e; --text-color: #e0e0e0; --border-color: #4a4a7a; --border-radius: 8px; }
        body { font-family: 'Poppins', sans-serif; background: var(--background-color); color: var(--text-color); margin: 0; padding: 20px; }
        .container { max-width: 900px; margin: 20px auto; padding: 20px; background: var(--secondary-color); border-radius: var(--border-radius); box-shadow: 0 4px 20px rgba(0,0,0,0.3); }
        h1, h2 { color: var(--primary-color); text-align: center; }
        .form-section, .collection-section, .info-section { margin-top: 30px; padding-top: 20px; border-top: 1px solid var(--border-color); }
        .form-group { margin-bottom: 15px; }
        .form-group label { display: block; margin-bottom: 5px; font-weight: 600; }
        .form-group input, .form-group select { width: 100%; padding: 10px; border-radius: 5px; border: 1px solid var(--border-color); background: #1a1a2e; color: var(--text-color); font-family: 'Poppins'; }
        .btn { display: block; width: 100%; padding: 12px; background: var(--primary-color); color: #fff; border: none; border-radius: 5px; font-size: 16px; font-weight: bold; cursor: pointer; transition: background 0.3s; }
        .btn:hover { background: #0ddfdb; }
        .collection-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px; margin-top: 20px; }
        .item-card { background: #1a1a2e; padding: 15px; border-radius: var(--border-radius); border-left: 4px solid var(--primary-color); }
        .item-card h3 { margin: 0 0 10px 0; color: var(--text-color); font-size: 1.1em; }
        .item-card p { margin: 5px 0; font-size: 0.9em; }
        .item-card .delete-btn { display: inline-block; margin-top: 10px; color: #ff4d4d; text-decoration: none; font-size: 0.9em; font-weight: 600; }
        .notification { padding: 15px; margin-bottom: 20px; border-radius: 5px; color: #fff; background-color: #27ae60; text-align: center; }
    </style>
</head>
<body>

    <div class="container">
        <h1>📚 Perpustakaan Digital</h1>

        <?php
        if (isset($_SESSION['message'])) {
            echo '<div class="notification">' . $_SESSION['message'] . '</div>';
            unset($_SESSION['message']);
        }
        ?>

        <div class="form-section">
            <h2>Tambah Koleksi Baru</h2>
            <form action="app.php" method="POST">
                <div class="form-group">
                    <label for="type">Tipe Media</label>
                    <select id="type" name="type" required onchange="toggleFields()">
                        <option value="book">Buku</option>
                        <option value="movie">Film</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="title">Judul</label>
                    <input type="text" id="title" name="title" required>
                </div>
                <div class="form-group" id="author-field">
                    <label for="author">Penulis</label>
                    <input type="text" id="author" name="author">
                </div>
                <div class="form-group" id="year-field" style="display: none;">
                    <label for="year">Tahun Rilis</label>
                    <input type="number" id="year" name="year" min="1800" max="2025">
                </div>
                <button type="submit" name="submit" class="btn">Simpan ke Koleksi</button>
            </form>
        </div>

        <div class="collection-section">
            <h2>Koleksi Saat Ini</h2>
            <div class="collection-grid">
                <?php if (empty($library->getCollection())): ?>
                    <p>Koleksi masih kosong.</p>
                <?php else: ?>
                    <?php foreach ($library as $id => $item): ?>
                        <div class="item-card">
                            <h3><?= cetakDetailMedia($item) ?></h3>
                            <p><?= htmlspecialchars($item->getCopyright()) ?></p>
                            <a href="app.php?action=delete&id=<?= urlencode($id) ?>" class="delete-btn" onclick="return confirm('Yakin ingin menghapus item ini?')">Hapus</a>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
        
        <div class="info-section">
            <h3>Informasi Tambahan & Demonstrasi Konsep</h3>
            <p>Total objek media yang pernah dibuat sesi ini: <?= Models\Media::getObjectCount() ?></p>
            <?php
                // Demonstrasi Serialization & Cloning
                $serialized = serialize($library);
                $unserializedLibrary = unserialize($serialized);
                echo "<p>Hasil Unserialize (dari __toString): " . $unserializedLibrary . "</p>";

                $clonedLibrary = clone $library;
                
                // Demonstrasi Reflection
                echo "<h4>Analisis Class 'Library' via Reflection:</h4>";
                $reflection = new \ReflectionClass(Library::class);
                echo "<ul>";
                echo "<li>Class Library adalah final? " . ($reflection->isFinal() ? 'Ya' : 'Tidak') . "</li>";
                echo "<li>Class Library memiliki method __clone? " . ($reflection->hasMethod('__clone') ? 'Ya' : 'Tidak') . "</li>";
                echo "</ul>";
            ?>
        </div>
    </div>

    <script>
        function toggleFields() {
            const type = document.getElementById('type').value;
            const authorField = document.getElementById('author-field');
            const yearField = document.getElementById('year-field');
            const authorInput = document.getElementById('author');
            const yearInput = document.getElementById('year');

            if (type === 'book') {
                authorField.style.display = 'block';
                yearField.style.display = 'none';
                authorInput.required = true;
                yearInput.required = false;
            } else {
                authorField.style.display = 'none';
                yearField.style.display = 'block';
                authorInput.required = false;
                yearInput.required = true;
            }
        }
        document.addEventListener('DOMContentLoaded', toggleFields);
    </script>
</body>
</html>