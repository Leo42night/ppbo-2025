<?php
// 1. Buat trait Pesan dengan method tampilPesan()
//    Method ini menampilkan tulisan "Halo, ini pesan dari trait!"
trait Pesan {
    public function tampilPesan() {
        return "HaLo, ini pesan dari trait!";
    }
}
// 2. Buat trait Logger dengan method log()
//    Method log menerima parameter $pesan dan menampilkan "[LOG]: <pesan>"
trait Logger {
    public function logActivity($pesan) {
        echo "[LOG] " . $pesan . "<br>";
    }
}

class User {
    use Logger, Pesan;
    private $nama;


    public function __construct($nama) {
        $this->nama = $nama;
    }

    public function pesan(){
        return "HaLo, ini pesan dari trait!";
    }
    public function logActivity($pesan) {
        echo "". $pesan . "<br>";
    }
    public function getNama() {
        return $this->nama;
    }
}
class Admin extends User {
    use Logger;
}

// MAIN PROGRAM
$user1 = new User("Budi");
$admin1 = new Admin("Andi");


// Panggil method dari trait
$user1->tampilPesan();
$user1->logActivity("User " . $user1->getNama() . " berhasil login.");

$admin1->logActivity("Admin " . $admin1->getNama() . " menghapus data.");
