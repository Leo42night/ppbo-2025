<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Hotel App' ?></title>
    <style>
        body { font-family: Arial; background: #f8f8f8; padding: 20px; }
        .card { background: white; padding: 20px; border-radius: 10px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
        .header { font-size: 1.4em; color: #333; margin-bottom: 15px; }
    </style>
</head>
<body>
    <div class="card">
        <?= $content ?? '' ?>
    </div>
</body>
</html>
