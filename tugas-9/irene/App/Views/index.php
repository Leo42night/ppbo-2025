<?php
require 'autoload.php';

use App\Controllers\ReservasiController;
use App\Core\Database;

$db = new Database();
$controller = new ReservasiController($db);

$controller->buatReservasi("Nasha", "Deluxe", "2025-10-15");


