<?php
namespace App\Service;
use App\Controller\PerpustakaanController;
use App\Model\Buku;
use App\Model\Majalah;

class PerpustakaanService {
    private $controller;

    public function __construct(PerpustakaanController $controller) {
        $this->controller = $controller;
    }

    public function tambahSampleItems() {
        $this->controller->tambahItem(new Buku("Seporsi Mie Ayam", "Brian Khrisna",2025,"12345ABC"));
        $this->controller->tambahItem(new Buku("Laut Bercerita", "Leila Chudori",2017,"66958DDC"));
        $this->controller->tambahItem(new Majalah("Teknologi Terkini", "Yayes",2023,"98765XYZ"));
    }
}