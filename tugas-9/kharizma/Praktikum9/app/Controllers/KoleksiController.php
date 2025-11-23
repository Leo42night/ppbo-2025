<?php
namespace App\Controllers;

use App\Models\Koleksi;
use App\Models\Buku;
use App\Models\DVD;
use App\Models\Majalah;

class KoleksiController {
    private $koleksi;

    public function __construct() {
        $this->koleksi = new Koleksi();
    }

    public function index() {
        include __DIR__ . '/../Views/header.php';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $jenis = $_POST['jenis'];
            $judul = $_POST['judul'];
            $pengarang = $_POST['pengarang'];
            $tahun = $_POST['tahun'];

            switch ($jenis) {
                case 'buku':
                    $objek = new Buku($judul, $pengarang, $tahun);
                    break;
                case 'dvd':
                    $objek = new DVD($judul, $pengarang, $tahun);
                    break;
                case 'majalah':
                    $objek = new Majalah($judul, $pengarang, $tahun);
                    break;
                default:
                    $objek = null;
            }

            if ($objek) $this->koleksi->tambahItem($objek);
        }

        include __DIR__ . '/../Views/form.php';
        include __DIR__ . '/../Views/daftar.php';
    }
}
