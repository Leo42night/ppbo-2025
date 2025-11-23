<?php


// 1. ENCAPSULATION
// Buat class Produk dengan atribut: nama, harga (gunakan access modifier yang sesuai)
// Lengkapi constructor, setter, dan getter
// buat method umum: tampilkanInfo() dengan build in function number_format() untuk format harga


class Produk {
    // TODO: isi atribut private $nama, $harga
    private $nama;
    private $harga;

    // TODO: buat constructor dengan parameter ($nama, $harga)
    public function __construct($nama, $harga) {
        $this->nama = $nama;
        $this->harga = $harga;
    }

    // TODO: buat getter dan setter untuk masing-masing atribut
    public function getNama() { return $this->nama; }
    public function getharga() { return $this->harga; }
    public function setNama($nama) { $this->nama = $nama; }
    public function setharga($harga) { $this->harga = $harga; }


    // TODO: buat method umum: tampilkanInfo(), format harga menggunakan number_format() (15200 jadi 15.200)
    public function tampilkanInfo() {
        return "produk: {$this->nama}, harga: Rp" . number_format($this->harga,0,",",".");
}
}



// 2. INHERITANCE
// Buat class Buku yang mewarisi dari Produk
// Tambahkan atribut baru: penulis
// Override method tampilkanInfo()


class Buku extends Produk {
    // TODO: buat atribut $penulis
    private $penulis;

    // TODO: buat constructor (nama, harga, penulis)
    public function __construct($nama, $harga, $penulis) {
        parent::__construct($nama, $harga);
        $this->penulis = $penulis;
    }

    // TODO: override method tampilkanInfo()
    public function tampilkanInfo() {   
        return "Buku : {this->getNama()}, harga: Rp ". number_format($this->getHarga(),0,",",);
    }
}




// 3. POLYMORPHISM
// Buat class Elektronik yang juga mewarisi dari Produk
// Override method tampilkanInfo() dengan cara berbeda dari INHERITANCE (pakai __construct)
class elektronik extends Produk {
    public function tampilkanInfo() {
        return "elektronik: {$this->getNama()}, harga: Rp ". number_format($this->getHarga(),o,',','.');
        }
    }

class Elektronik extends Produk {
    // TODO: constructor (nama, harga)
    public function __construct ($nama, $harga){
        parent: __construct($nama, $harga);
        $this->penulis = $penulis;
    }
    // TODO: override method tampilkanInfo()
}



// 4. ABSTRACTION
// Buat abstract class User dengan method abstract getRole()
// Buat class Admin dan Customer yang meng-extend User dan mengimplementasikan getRole()


abstract class User {
    protected $username;
    public function __construct($username) {
        $this->username = $username;
    }


    // TODO: buat abstract method getRole()
    abstract public function getRole();
}


class Admin extends user {
    // TODO: implementasikan getRole()
    public function getRole() {
        return "admin: {$this->username}";
    }
}


class Customer extends User {
    public function getRole() {
        return "Costumer: {$this->username}";
    }
    }


// MAIN PROGRAM
$buku1 = new Buku ("pemrograman PHP", 8000, "budi");
$elektronik1 = new Elektronik("Laptop", 7000000);

echo $buku1->tampilkanInfo() . "\n";
echo $elektronik1->tampilkanInfo() . "\n";

$admin = new Admin("Leo");
$customer = new Customer("Andi");


echo $admin->getRole() . "<br>";
echo $customer->getRole() . "<br>";
