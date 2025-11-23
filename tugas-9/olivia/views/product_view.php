<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Detail Produk</title>
    <style>
        body { font-family: sans-serif; line-height: 1.6; padding: 20px; }
        .container { max-width: 600px; margin: auto; border: 1px solid #ddd; padding: 20px; border-radius: 5px; }
        h1 { color: #333; }
    </style>
</head>
<body>
    <div class="container">
        <?php if ($product): ?>
            <h1>Detail Produk: <?= htmlspecialchars($product->getName()) ?></h1>
            <p><strong>ID:</strong> <?= $product->getProductID() ?></p>
            <p><strong>Tipe:</strong> <?= htmlspecialchars($product->getProductType()) ?></p>
            <p><strong>Harga:</strong> Rp <?= number_format($product->getPrice(), 2) ?></p>
            <p><strong>Harga + PPN (<?= \App\Models\AbstractProduct::TAX * 100 ?>%):</strong> Rp <?= number_format($product->getPriceWithTax(), 2) ?></p>
            <?php if ($product instanceof \App\Models\Book): ?>
                <p><strong>Penulis:</strong> <?= htmlspecialchars($product->getAuthor()) ?></p>
            <?php elseif ($product instanceof \App\Models\Electronics): ?>
                <p><strong>Merek:</strong> <?= htmlspecialchars($product->getBrand()) ?></p>
            <?php endif; ?>
        <?php else: ?>
            <h1>Produk Tidak Ditemukan</h1>
        <?php endif; ?>
    </div>
</body>
</html>