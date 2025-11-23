<?php
namespace App\Models;

use App\Models\Interface\CrudInterface;
use App\Models\Trait\Logger;

class Koleksi implements CrudInterface {
    use Logger;

    private static $daftar = [];

    public function tambahItem($item) {
        self::$daftar[] = $item;
        $this->log("Tambah item: " . $item->getJudul());
    }

    public function hapusItem($judul) {
        foreach (self::$daftar as $key => $item) {
            if ($item->getJudul() === $judul) {
                unset(self::$daftar[$key]);
                $this->log("Hapus item: $judul");
                break;
            }
        }
    }

    public function tampilkanSemua() {
        return self::$daftar;
    }
}
