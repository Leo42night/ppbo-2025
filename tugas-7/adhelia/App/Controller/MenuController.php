<?php
namespace App\Controller;

use App\Repository\MenuRepository;
use App\View\MenuView;

class MenuController {
    private MenuRepository $repo;
    private MenuView $view;

    public function __construct(MenuRepository $repo, MenuView $view) {
        $this->repo = $repo;
        $this->view = $view;
    }

    public function seedData() {
        echo "Seed data jalan\n";
    }

    public function tampilkanMenu() {
        echo "Tampilkan menu jalan\n";
    }
}
