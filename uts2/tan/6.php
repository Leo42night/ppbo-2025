<?php

// 1. Buat trait Pesan dengan method tampilPesan()
trait Pesan {
    public function tampilPesan() {
        echo "Halo, ini pesan dari trait!" . "\n";
    }
}

// 2. Buat trait Logger dengan method log()
trait Logger {
    public function log($pesan) {
        echo "[LOG]: " . $pesan . "\n";
    }
}

// 3. Buat class User yang menggunakan trait Pesan dan Logger
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

// 4. Buat class Admin yang mewarisi User
class Admin extends User {
    use Logger;
}

$user1 = new User("Budi");
$admin1 = new Admin("Andi");

$user1->tampilPesan();  
$user1->log("User  " . $user1->getNama() . " berhasil login.");  
$admin1->log("Admin " . $admin1->getNama() . " menghapus data.");  

?>
