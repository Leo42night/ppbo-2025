<?php
session_start();

// Simpan pesan ke session
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['name'], $_POST['message'])) {
    $_SESSION['guestbook'][] = [
        'name' => htmlspecialchars($_POST['name']),
        'message' => htmlspecialchars($_POST['message']),
        'time' => date("d-m-Y H:i")
    ];
}
$messages = $_SESSION['guestbook'] ?? [];
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Buku Tamu Pernikahan</title>
  <style>
    body {
      font-family: 'Georgia', serif;
      background: linear-gradient(to right, #fff0f5, #ffe4e1);
      margin: 0; padding: 0;
    }
    .container {
      max-width: 700px;
      margin: 30px auto;
      background: white;
      padding: 25px;
      border-radius: 15px;
      box-shadow: 0 0 15px rgba(0,0,0,0.1);
      text-align: center;
    }
    h1 {
      font-family: 'Brush Script MT', cursive;
      color: #c71585;
      font-size: 42px;
      margin-bottom: 10px;
    }
    .subtitle {
      font-size: 18px;
      color: #666;
      margin-bottom: 20px;
    }
    form {
      margin-bottom: 25px;
    }
    input, textarea {
      width: 90%;
      padding: 10px;
      margin: 10px 0;
      border-radius: 8px;
      border: 1px solid #ccc;
      font-size: 16px;
    }
    button {
      background: #c71585;
      color: white;
      padding: 10px 25px;
      border: none;
      border-radius: 20px;
      font-size: 16px;
      cursor: pointer;
      transition: 0.3s;
    }
    button:hover {
      background: #a0136e;
    }
    .messages {
      text-align: left;
      margin-top: 20px;
    }
    .card {
      background: #fffafc;
      border: 1px solid #f8c8dc;
      border-radius: 10px;
      padding: 15px;
      margin-bottom: 10px;
      text-align: left;
    }
    .card strong {
      color: #c71585;
      font-size: 18px;
    }
    .time {
      font-size: 12px;
      color: #777;
      float: right;
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>Buku Tamu</h1>
    <div class="subtitle">Selamat datang di pernikahan <b>Aisyah & Abdul</b> 💍</div>

    <form method="POST">
      <input type="text" name="name" placeholder="Nama Anda" required><br>
      <textarea name="message" rows="4" placeholder="Pesan & Doa" required></textarea><br>
      <button type="submit">Kirim Ucapan</button>
    </form>

    <div class="messages">
      <h2>Ucapan & Doa 💌</h2>
      <?php if (empty($messages)): ?>
        <p>Belum ada ucapan, jadilah yang pertama!</p>
      <?php else: ?>
        <?php foreach (array_reverse($messages) as $msg): ?>
          <div class="card">
            <div class="time"><?= $msg['time'] ?></div>
            <strong><?= $msg['name'] ?></strong><br>
            <p><?= $msg['message'] ?></p>
          </div>
        <?php endforeach; ?>
      <?php endif; ?>
    </div>
  </div>
</body>
</html>
