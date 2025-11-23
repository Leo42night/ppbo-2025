<?php
trait Pesan {
    public function tampilPesan() {
        echo "Halo, ini pesan dari trait!\n";
    }
}

trait Logger {
    public function log($pesan) {
        echo "[LOG]: " . $pesan . "\n";
    }
}

class User {
    use Pesan;
    use Logger;

    private $nama;

    public function __construct($nama) {
        $this->nama = $nama;
    }

    public function getNama() {
        return $this->nama;
    }
}

class Admin extends User {
    use Logger; 
}

$user1 = new User("Budi");
$admin1 = new Admin("Andi");

$user1->tampilPesan();
$user1->log("User " . $user1->getNama() . " berhasil login.");
$admin1->log("Admin " . $admin1->getNama() . " menghapus data.");
?>