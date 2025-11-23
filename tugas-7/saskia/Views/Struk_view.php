<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Struk Bakmie Nuosa</title>
    <style>
        body { font-family: 'Courier New', Courier, monospace; }
        .struk { border: 2px solid #333; padding: 15px; max-width: 450px; }
        .total { font-weight: bold; border-top: 1px dashed #333; margin-top: 10px; padding-top: 10px; }
        .header { text-align: center; }
    </style>
</head>
<body>
    <?php if (isset($data['struk']) && $data['struk'] !== null): ?>
        <div class="struk">
            <div class="header">
                <h2>--- Bakmie Nuosa ---</h2>
                <p>Taste of Nusantara</p>
            </div>
            <p><strong>Pesanan:</strong> <?= htmlspecialchars($data['pesanan']); ?></p>
            <hr>
            <h4>DETAIL PESANAN:</h4>
            <table>
                <?php foreach ($data['pesanan']->getItems() as $item): ?>
                    <tr>
                        <td style="padding-right: 15px;"><?= htmlspecialchars($item->getNama()); ?></td>
                        <td style="text-align: right;">Rp <?= number_format($item->getHarga()); ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
            <p>Diskon: <?= htmlspecialchars($data['pesanan']->getPersenDiskon()); ?>%</p>
            <hr>
            <p>Subtotal (Setelah Diskon): Rp <?= number_format($data['struk']['subtotal']); ?></p>
            <p>PPN (11%): Rp <?= number_format($data['struk']['ppn']); ?></p>
            <p class="total">TOTAL: Rp <?= number_format($data['struk']['total']); ?></p>
        </div>
    <?php endif; ?>
    <hr>
    <p>Total pesanan diproses hari ini: <?= htmlspecialchars($data['totalPesananHariIni']); ?></p>
</body>
</html>