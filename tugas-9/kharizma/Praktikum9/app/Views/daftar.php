<h3>Daftar Koleksi</h3>
<?php
$daftar = $this->koleksi->tampilkanSemua();
if (empty($daftar)) {
    echo "<p><i>Belum ada koleksi.</i></p>";
} else {
    foreach ($daftar as $item) {
        echo "<div class='card'>" . $item->getInfo() . "</div>";
    }
}
?>
</main>
<footer>© 2025 Sistem Perpustakaan OOP | Praktikum PBO</footer>
</body>
</html>
