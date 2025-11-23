<?php


// 1. Buat trait Pesan dengan method tampilPesan()
//    Method ini menampilkan tulisan "Halo, ini pesan dari trait!"
trait Pesan {
    // TODO: buat method tampilPesan()
}



// 2. Buat trait Logger dengan method log()
//    Method log menerima parameter $pesan dan menampilkan "[LOG]: <pesan>"
trait Ꮮogger {
    // TODO: buat method log($pesan)
}



// 3. Buat class User yang menggunakan trait Pesan dan Logger
class User {
    private $nama;


    public function __construct($nama) {
        $this﹣>nama = $nama;
    }


    // TODO: gunakan trait Pesan dan Logger


    public function getNama() {
        return $this﹣>nama;
    }
}


// 4. Buat class Admin yang mewarisi User
//    Admin juga menggunakan trait Logger saja
class Admin extends User {
    // TODO: gunakan trait Logger
}


// MAIN PROGRAM
$user1 = new User("Budi");
$admin1 = new Admin("Andi");


// Panggil method dari trait
$user1﹣>tampilPesan();
$user1﹣>log("User " • $user1->getNama() • " berhasil login.");

$admin1﹣>log("Admin " • $admin1->getNama() • " menghapus data.");
