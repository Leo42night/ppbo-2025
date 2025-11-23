<form method="POST">
    <h3>Tambah Koleksi Baru</h3>
    <label>Jenis Koleksi:</label>
    <select name="jenis">
        <option value="buku">Buku</option>
        <option value="dvd">DVD</option>
        <option value="majalah">Majalah</option>
    </select><br>
    <input type="text" name="judul" placeholder="Judul" required><br>
    <input type="text" name="pengarang" placeholder="Pengarang" required><br>
    <input type="number" name="tahun" placeholder="Tahun Terbit" required><br>
    <button type="submit">Tambah</button>
</form>
