<?php
namespace App\Models\Interface;

interface CrudInterface {
    public function tambahItem($item);
    public function hapusItem($judul);
    public function tampilkanSemua();
}
