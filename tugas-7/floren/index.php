<?php
require_once "classes.php";

// untuk repository
$repo = new MahasiswaRepository();


// Tambah data (simulasi)
if (isset($_POST['tambah'])) {
    $repo->add(new Mahasiswa(
        Counter::increment(),
        $_POST['nama'],
        $_POST['nim'],
        $_POST['jurusan']
    ));
}

// Hapus data
if (isset($_GET['hapus'])) {
    $repo->delete($_GET['hapus']);
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Pendataan Mahasiswa</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(to right, #9c6d9cff, #a95097ff);
            text-align: center;
            padding: 40px;
            color: white;
        }
        .card {
            background: rgba(0,0,0,0.6);
            padding: 30px;
            border-radius: 15px;
            display: inline-block;
            box-shadow: 0 5px 15px rgba(0,0,0,0.3);
            width: 700px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top:20px;
        }
        table, th, td {
            border:1px solid white;
            padding: 10px;
        }
        th {
            background:#659cb9ff;
        }
        a, button {
            display:inline-block;
            margin-top:10px;
            padding:6px 15px;
            background:#659cb9ff;
            color:white;
            border:none;
            border-radius:8px;
            cursor:pointer;
            text-decoration:none;
        }
        a:hover, button:hover {
            background:#388e3c;
        }
        input {
            padding:6px;
            border-radius:6px;
            border:none;
        }
    </style>
</head>
<body>
    <div class="card">
        <h1><?= AppConfig::APP_NAME ?></h1>
        
        <form method="post">
            <input type="text" name="nama" placeholder="Nama" required>
            <input type="text" name="nim" placeholder="NIM" required>
            <input type="text" name="jurusan" placeholder="Jurusan" required>
            <button type="submit" name="tambah">Tambah</button>
        </form>

        <table>
            <tr>
                <th>ID</th><th>Nama</th><th>NIM</th><th>Jurusan</th><th>Aksi</th>
            </tr>
            <?php foreach ($repo->all() as $m): ?>
            <tr>
                <td><?= $m->id ?></td>
                <td><?= $m->nama ?></td>
                <td><?= $m->nim ?></td>
                <td><?= $m->jurusan ?></td>
                <td>
                    <a href="?hapus=<?= $m->id ?>" onclick="return confirm('Yakin hapus?')">Hapus</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>
</body>
</html>
