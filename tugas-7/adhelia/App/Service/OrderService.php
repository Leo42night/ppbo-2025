<?php
namespace App\Service;

use App\Repository\MenuRepository;
use App\Model\Menu;

class OrderService {
    private MenuRepository $repo;

    public function __construct(MenuRepository $repo) {
        $this->repo = $repo;
    }

    public function pesan(Menu $menu): void {
        $this->repo->tambah($menu);
    }
}
