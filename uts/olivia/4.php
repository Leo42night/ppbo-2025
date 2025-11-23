<?php

// 1. ENCAPSULATION
// Buat class Produk dengan atribut: nama, harga (gunakan access modifier yang sesuai)
// Lengkapi constructor, setter, dan getter
// buat method umum: tampilkanInfo() dengan build in function number_format() untuk format harga

class Produk {
    private $nama;
    private $harga;
    // TODO: buat constructor dengan parameter ($nama, $harga)
    public function __construct($nama, $harga) {
        $this->nama = $nama;
        $this->harga = $harga;
    }
    // TODO: buat getter dan setter untuk masing-masing atribut
    public function getNama () {
        return $this->nama; 
    }
    public function setNama ($nama) {
        $this->nama = $nama;
    }
    public function getHarga () {
        return $this->harga;
    }
    public function setHarga ($harga) {
        $this->harga = $harga;
    }
    // TODO: buat method umum: tampilkanInfo(), format harga menggunakan number_format() (15200 jadi 15.200)
    public function tampilkanInfo () {
        return "Barang: " . $this->nama ." ". $this->harga ."";
    }
}

// 2. INHERITANCE
// Buat class Buku yang mewarisi dari Produk
// Tambahkan atribut baru: penulis
// Override method tampilkanInfo()

class Buku extends Produk {
    // TODO: buat atribut $penulis
    private $penulis;

    public function __construct($nama, $penulis, $harga) {
        $this->penulis = $penulis;
        $this->nama = $nama;
        $this->harga = $harga;
    }
    // TODO: buat constructor (nama, harga, penulis)
    // TODO: override method tampilkanInfo()
    public function tampilkanInfo () {
        return "Judul: \"{$this->nama}\", Penulis: {$this->penulis}, Harga: {$this->harga}";
    }
}

// 3. POLYMORPHISM
// Buat class Elektronik yang juga mewarisi dari Produk
// Override method tampilkanInfo() dengan cara berbeda dari INHERITANCE (pakai __construct)
class Elektronik extends Produk {
    // TODO: constructor (nama, harga)
    // TODO: override method tampilkanInfo()
    public function __construct($nama, $harga) {

}



// 4. ABSTRACTION
// Buat abstract class User dengan method abstract getRole()
// Buat class Admin dan Customer yang meng-extend User dan mengimplementasikan getRole()


abstract class User {
    protected $username;


    public function __construct($username) {
        $this->username = $username;
    }
    public function getRole();
    // TODO: buat abstract method getRole()
}


class Admin extend User {
    // TODO: implementasikan getRole()
}


class Customer extend User {
    // TODO: implementasikan getRole()
}


// MAIN PROGRAM
$buku1 = new Buku("Pemrograman PHP", 80000, "Budi");
$elektronik1 = new Elektronik("Laptop", 7000000);

echo $buku1->tampilkanInfo() . "\n";
echo $elektronik1->tampilkanInfo() . "\n"

$admin = new Admin("Leo");
$customer = new Customer("Andi");


echo $admin->getRole() . "<br>";
echo $customer->getRole() . "<br>";
?>