<?php
require_once __DIR__ . '/Praktikum9/app/autoload.php';
use App\Controllers\KoleksiController;

$controller = new KoleksiController();
$controller->index();
