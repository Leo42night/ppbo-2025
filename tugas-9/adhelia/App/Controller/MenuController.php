<?php
namespace App\Controller;

use App\Repository\MenuRepository;
use App\View\MenuView;
use App\Traits\Loggable;

class MenuController {
    use Loggable;
    private MenuRepository $repo;
    private MenuView $view;

    public function __construct(MenuRepository $repo, MenuView $view) {
        $this->repo = $repo;
        $this->view = $view;
    }

    public function seedData(): void {
        $this->log("Seed data jalan");
        echo "Seed data jalan\n";
    }

    public function tampilkanMenu(): void {
        $this->log("Tampilkan menu jalan");
        echo "Tampilkan menu jalan\n";
    }
}
