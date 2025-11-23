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
    public function __construct($nama,$harga){
        $this->nama = $nama;
        $this->harga = $harga;
    }
    // TODO: buat method umum: tampilkanInfo(), format harga menggunakan number_format() (15200 jadi 15.200)
    public function tampilkanInfo(){
        echo "Nama Produk $this->nama";
    }
    public function number_format(){
        echo "Harga Produk $this->harga";
    }
    // TODO: buat getter dan setter untuk masing-masing atribut

}



// 2. INHERITANCE
// Buat class Buku yang mewarisi dari Produk
// Tambahkan atribut baru: penulis
// Override method tampilkanInfo()


class Buku extends Produk {
    public $penulis;
    public function __construct($nama,$harga,$penulis){
        $this->nama = $nama;
        $this->harga = $harga;
        $this->penulis = $penulis;
    }
    public function tampilkanInfo(){
        echo "Buku: $this->nama\n";
        echo "Harga: $this->harga\n";
        echo "Penulis: $this->penulis\n";

    // TODO: buat atribut $penulis


    // TODO: buat constructor (nama, harga, penulis)


    // TODO: override method tampilkanInfo()
}
}



// 3. POLYMORPHISM
// Buat class Elektronik yang juga mewarisi dari Produk
// Override method tampilkanInfo() dengan cara berbeda dari INHERITANCE (pakai __construct)


class Elektronik extends Produk{
    public function __construct($nama,$harga){
        $this->nama = $nama;
        $this->harga = $harga;
    }
    public function tampilkanInfo()
    {
        echo "Elektronik: $this->nama\n";
        echo "Harga: $this->harga\n";
    }
    // TODO: constructor (nama, harga)
    // TODO: override method tampilkanInfo()
}



// 4. ABSTRACTION
// Buat abstract class User dengan method abstract getRole()
// Buat class Admin dan Customer yang meng-extend User dan mengimplementasikan getRole()


abstract class User {
    protected $username;
    abstract function getRole();
    public function __construct($username) {
        $this->username = $username;
    }


    // TODO: buat abstract method getRole()
}


class Admin extends User {
    public function getRole(){
        echo "Admin: $this->username\n";
    }
    // TODO: implementasikan getRole()
}


class Customer extends User {
    public function getRole(){
        echo "Customer: $this->username\n";
    }
    // TODO: implementasikan getRole()
}


// MAIN PROGRAM
$buku1 = new Buku("Pemrograman PHP", 80000, "Budi");
$elektronik1 = new Elektronik("Laptop", 7000000);

echo $buku1->tampilkanInfo() . "\n";
echo $elektronik1->tampilkanInfo() . "\n";

$admin = new Admin("Leo");
$customer = new Customer("Andi");


echo $admin->getRole();
echo $customer->getRole();
?>