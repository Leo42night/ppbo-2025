<?php
// 1. ENCAPSULATION
// Buat class Produk dengan atribut: nama, harga (gunakan access modifier yang sesuai)
// Lengkapi constructor, setter, dan getter
// buat method umum: tampilkanInfo() dengan build in function number_format() untuk format harga
// TODO: isi atribut private $nama, $harga
class Produk
{
    private $nama;
    private $harga;
    // TODO: buat constructor dengan parameter ($nama, $harga)
    public function __construct($nama, $harga)
    {
    }
    // TODO: buat getter dan setter untuk masing-masing atribut
    private function getnama()
    {
        return "Nama";
    }

    private function setnama($nama)
    {
        $this->nama = $nama;
    }

    private function getharga()
    {
        return "Harga";
    }

    private function setharga($harga)
    {
        $this->harga = $harga;
    }

    // TODO: buat method umum: tampilkanInfo(), format harga menggunakan number_format() (15200 jadi 15.200)
    public function TampilkanInfo()
    {
        number_format(15.200);
    }

}

// 2. INHERITANCE
// Buat class Buku yang mewarisi dari Produk
// Tambahkan atribut baru: penulis
// Override method tampilkanInfo()
// TODO: buat atribut $penulis
class Buku extends Produk
{
    public $penulis;
    // TODO: buat constructor (nama, harga, penulis)
    public function __construct($nama, $harga, $penulis)
    {
        $this->penulis = $penulis;
    }
    // TODO: override method tampilkanInfo()
    public function TampilkanInfo()
    {
        return "Penulis e-book ini:";
    }
}

// 3. POLYMORPHISM
// Buat class Elektronik yang juga mewarisi dari Produk
// Override method tampilkanInfo() dengan cara berbeda dari INHERITANCE (pakai __construct)
class Elektronik extends Produk
{
    // TODO: constructor (nama, harga)
    public function __construct($nama, $harga)
    {
    }
    // TODO: override method tampilkanInfo()
    public function TampilkanInfo()
    {
        return "Nama: {$this->nama}, harga: {$this->harga} ";
    }
}

// 4. ABSTRACTION
// Buat abstract class User dengan method abstract getRole()
// Buat class Admin dan Customer yang meng-extend User dan mengimplementasikan getRole()
abstract class User
{
    protected $username;

    public function __construct($username)
    {
        $this->username = $username;
    }

    // TODO: buat abstract method getRole()
    abstract public function getRole();

}

class Admin extends User
{
    // TODO: implementasikan getRole()
    public function getRole()
    {
        return "Admin";
    }
}


class Customer extends User
{
    // TODO: implementasikan getRole()
    public function getRole()
    {
        return "Customer";
    }
}


// MAIN PROGRAM
$buku1 = new Buku("Pemrograman PHP", 80000, "Budi");
$elektronik1 = new Elektronik("Laptop", 7000000);

echo $buku1->tampilkanInfo() . "\n";
echo $elektronik1->tampilkanInfo() . "\n";

$admin = new Admin("Leo");
$customer = new Customer("Andi");


echo $admin->getRole() . "<br>";
echo $customer->getRole() . "<br>";
