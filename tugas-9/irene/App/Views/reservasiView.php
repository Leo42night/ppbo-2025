<?php
$title = "Hasil Reservasi";
ob_start(); // mulai buffer
?>
<div class="header">Detail Reservasi</div>
<p><b>Nama Tamu:</b> <?= htmlspecialchars($dataReservasi['namaTamu'] ?? '-') ?></p>
<p><b>Tipe Kamar:</b> <?= htmlspecialchars($dataReservasi['tipeKamar'] ?? '-') ?></p>
<p><b>Tanggal:</b> <?= htmlspecialchars($dataReservasi['tanggal'] ?? '-') ?></p>
<p><b>Status:</b> ✅ Berhasil Dibuat</p>
<?php
$content = ob_get_clean();
// include layout yang berada di folder Views -> gunakan __DIR__ agar path pasti
include __DIR__ . '/layout.php';
