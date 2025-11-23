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
    <h3>Daftar Item di Perpustakaan (dari Objek yang di-Unserialize):</h3>
    <ul>
        <?php foreach ($books as $item): ?>
            <li>
                <p><b>Output dari __toString():</b> <?= htmlspecialchars($item); ?></p>
                <p><b>Output dari getSummary():</b> <i><?= htmlspecialchars($item->getSummary()); ?></i></p>
            </li>
        <?php endforeach; ?>
    </ul>
    <p><b>Total buku yang pernah dibuat (static counter): <?= $totalBooks; ?></b></p>
</body>
</html>