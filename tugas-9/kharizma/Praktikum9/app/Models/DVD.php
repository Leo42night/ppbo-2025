<?php
namespace App\Models;

use App\Models\Interface\Borrowable;

class DVD extends Item implements Borrowable {
    private $status = "Tersedia";

    public function pinjam() { $this->status = "Dipinjam"; }
    public function kembali() { $this->status = "Tersedia"; }

    public function getInfo() {
        return "💿 DVD: {$this->judul} - {$this->pengarang} ({$this->tahun}) | Status: {$this->status}";
    }
}
