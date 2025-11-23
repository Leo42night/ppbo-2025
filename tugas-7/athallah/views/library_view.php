<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Buku</title>
    <style>
        body { font-family: sans-serif; }
        ul { list-style-type: none; padding: 0; }
        li { background: #f4f4f4; margin: 5px 0; padding: 10px; border-left: 5px solid #007bff; }
    </style>
</head>
<body>
    <h3>Daftar Buku di Perpustakaan:</h3>
    <ul>
        <?php foreach ($books as $book): ?>
            <li><?= htmlspecialchars($book); ?></li>
        <?php endforeach; ?>
    </ul>
    <p><b>Total buku yang pernah dibuat: <?= $totalBooks; ?></b></p>
</body>
</html>