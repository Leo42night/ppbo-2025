<?php
namespace App\Models;

class Majalah extends Item {
    public function getInfo() {
        return "📰 Majalah: {$this->judul} - {$this->pengarang} ({$this->tahun})";
    }
}
