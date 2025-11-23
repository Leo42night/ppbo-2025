<?php
namespace App\Repository;

use App\Model\Menu;

class MenuRepository implements \IteratorAggregate {
    private array $items = [];

    public function tambah(Menu $menu) {
        $this->items[] = $menu;
    }

    public function getIterator(): \Traversable {
        return new \ArrayIterator($this->items);
    }
}
