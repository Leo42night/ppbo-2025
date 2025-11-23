<?php
namespace App\Controller;

use App\Model\ItemPerpustakaan;
use Exception;

class PerpustakaanController {
    private $items = [];

    public function tambahItem(ItemPerpustakaan $item) {
        if (!$item) throw new Exception("Item tidak valid");
        $this->items[] = $item;
    }

    public function pinjamSemua() {
        foreach ($this->items as $item) {
            // include the shared view from PerpustakaanApp/views
            include __DIR__ . '/../../views/List_pinjam.php';
            $item->pinjam();
        }
    }

    public function simpanItems(): string {
        try {
            $data = serialize($this->items);
            // file_put_contents '/../../storage/items.dat';
            echo "[LOG] Data perpustakaan berhasil disimpan ke file.\n";
            return $data;
        } catch (Exception $e) {
            throw new Exception("Gagal menyimpan item: " . $e->getMessage());
        }
    }

    public function muatItems(): void {
        $path = __DIR__ . '/../../storage/items.dat';
        if (file_exists($path)) {
            $this->items = unserialize(file_get_contents($path));
            echo "[LOG] Item berhasil dimuat dari file.\n";
        }
    }
}