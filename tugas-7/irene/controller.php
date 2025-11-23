<?php
require_once "guestbook.php";

session_start();

// inisialisasi session
if (!isset($_SESSION['guestbook'])) {
    $_SESSION['guestbook'] = [];
}

// fungsi untuk tambah data
function addGuestMessage(string $name, string $message): void {
    $entry = new Message($name, $message);
    // simpan ke session
    $_SESSION['guestbook'][] = $entry;
}


 
