<?php
trait Pesan {
    public function tampilPesan() {
        echo "Halo, ini pesan dari trait.\n";
    }
}

trait Logger {
    public function log($pesan) {
        echo "[LOG]: $pesan.\n";
    }
}

class User {
    private $nama;

    public function __construct($nama) {
        $this->nama = $nama;
    }

    use Pesan, Logger;

    public function getNama() {
        return $this->nama;
    }
}

class Admin extends User {
    public function show() {
        $this->tampilPesan;
    }
}

$user1 = new User("Budi");
$admin1 = new Admin("Andi");

$user1->tampilPesan();
$user1->log("User " . $user1->getNama() . " berhasil login"); 
$user1->log("Admin " . $admin1->getNama() . " menghapus data"); 