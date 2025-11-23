<?php
// =================================================================
// BAGIAN CONTROLLER (Logika Aplikasi)
// =================================================================

// KESALAHAN ADA DI SINI: Autoloader harus dimuat SEBELUM session dimulai.
// Muat semua definisi class ("buku panduan") terlebih dahulu
require_once __DIR__ . '/../autoload.php';
// Baru mulai session, yang akan secara otomatis me-unserialize objek
session_start();

use Models\Book;
use Models\Movie;
use Core\Library;

// Inisialisasi Library di session jika belum ada
if (!isset($_SESSION['library'])) {
    $_SESSION['library'] = new Library();
}
$library = $_SESSION['library'];

// Logika untuk MENAMBAH item baru
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    $type = $_POST['type'];
    $title = htmlspecialchars($_POST['title']);
    
    if ($type === 'book' && !empty($_POST['author'])) {
        $author = htmlspecialchars($_POST['author']);
        $newItem = new Book($title, $author);
        $library->addItem($newItem);
    } elseif ($type === 'movie' && !empty($_POST['year'])) {
        $year = (int)$_POST['year'];
        $newItem = new Movie($title, $year);
        $library->addItem($newItem);
    }
    header("Location: app.php"); // Redirect untuk mencegah resubmit form
    exit;
}

// Logika untuk MENGHAPUS item
if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id'])) {
    $id = $_GET['id'];
    $library->deleteItem($id);
    header("Location: app.php"); // Redirect
    exit;
}

// =================================================================
// BAGIAN VIEW (Tampilan HTML & CSS)
// =================================================================
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Perpustakaan Digital</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #0abfbc; --secondary-color: #2c2c54;
            --background-color: #1a1a2e; --text-color: #e0e0e0;
            --border-color: #4a4a7a; --border-radius: 8px;
        }
        body { font-family: 'Poppins', sans-serif; background: var(--background-color); color: var(--text-color); margin: 0; padding: 20px; }
        .container { max-width: 900px; margin: 20px auto; padding: 20px; background: var(--secondary-color); border-radius: var(--border-radius); box-shadow: 0 4px 20px rgba(0,0,0,0.3); }
        h1, h2 { color: var(--primary-color); text-align: center; }
        .form-section, .collection-section { margin-top: 30px; }
        .form-group { margin-bottom: 15px; }
        .form-group label { display: block; margin-bottom: 5px; font-weight: 600; }
        .form-group input, .form-group select { width: 100%; padding: 10px; border-radius: 5px; border: 1px solid var(--border-color); background: #1a1a2e; color: var(--text-color); font-family: 'Poppins'; }
        .btn { display: block; width: 100%; padding: 12px; background: var(--primary-color); color: #fff; border: none; border-radius: 5px; font-size: 16px; font-weight: bold; cursor: pointer; transition: background 0.3s; }
        .btn:hover { background: #0ddfdb; }
        .collection-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px; margin-top: 20px; }
        .item-card { background: #1a1a2e; padding: 15px; border-radius: var(--border-radius); border-left: 4px solid var(--primary-color); }
        .item-card h3 { margin: 0 0 10px 0; color: var(--text-color); }
        .item-card p { margin: 5px 0; font-size: 0.9em; }
        .item-card .delete-btn { display: inline-block; margin-top: 10px; color: #ff4d4d; text-decoration: none; font-size: 0.9em; }
    </style>
</head>
<body>

    <div class="container">
        <h1>📚 Perpustakaan Digital</h1>

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
                    <input type="number" id="year" name="year">
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
                    <?php foreach ($library->getCollection() as $id => $item): ?>
                        <div class="item-card">
                            <h3><?= htmlspecialchars($item->getTitle()) ?></h3>
                            <p><?= htmlspecialchars($item->getDetails()) ?></p>
                            <a href="app.php?action=delete&id=<?= urlencode($id) ?>" class="delete-btn" onclick="return confirm('Yakin ingin menghapus item ini?')">Hapus</a>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
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
        // Panggil saat halaman dimuat untuk memastikan field yang benar tampil
        toggleFields();
    </script>

</body>
</html>