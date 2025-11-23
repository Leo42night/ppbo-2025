<?php
require 'autoload.php'; // cukup satu kali

// Mengecek apakah file Database.php dan class Database ada
var_dump(file_exists(__DIR__ . '/App/Core/Database.php')); 
var_dump(class_exists('App\\Core\\Database'));

use App\Controllers\ReservasiController;
use App\Core\Database;


$db = new Database();
$controller = new ReservasiController($db);


$dataReservasi = $controller->buatReservasi("Nasha", "Deluxe", "2025-08-15");

// Tambahkan baris ini untuk memanggil tampilan
include 'App/Views/reservasiView.php';
