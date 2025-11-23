<?php


// 1. ENCAPSULATION
// Buat class Produk dengan atribut: nama, harga (gunakan access modifier yang sesuai)
// Lengkapi constructor, setter, dan getter
// buat method umum: tampilkanInfo() dengan build in function number_format() untuk format harga

class Produk
{
    public $nama;
    public $harga;
    public $stok;

    public function __construct($nama, $harga, $stok)
    {
        $this->nama = $nama;
        $this->harga = $harga;
        $this->stok = $stok;
    }

    public function tampilkanInfo()
    {
        echo "Nama: {$this->nama}, Harga: {$this->harga}, Stok: {$this->stok}\n";
    }

    public function beliProduk($jumlah)
    {
        $this->stok -= $jumlah;
    }
}

$produk = new Produk("Buku", 50000, 20);

$produk->tampilkanInfo();
// Output: Nama: Buku, Harga: 50000, Stok: 20

$produk->beliProduk(5);

$produk->tampilkanInfo();
// Output: Nama: Buku, Harga: 50000, Stok: 15

// 2. INHERITANCE
// Buat class Buku yang mewarisi dari Produk
// Tambahkan atribut baru: penulis
// Override method tampilkanInfo()


class Buku extends Produk {
    public
    // TODO: buat atribut $penulis
    public $penulis;
    public function get_penulis() {
        return $this->penulis;
    }


    // TODO: buat constructor (nama, harga, penulis)
    public function __construct($nama, $harga, $penulis) {
        $this->nama = $nama;
        $this->harga = $harga;
        $this->penulis = $penulis;
    }
}


    // TODO: override method tampilkanInfo()



// 3. POLYMORPHISM
// Buat class Elektronik yang juga mewarisi dari Produk
// Override method tampilkanInfo() dengan cara berbeda dari INHERITANCE (pakai __construct)


class Elektronik extends Produk {
    public function __construct($nama, $harga) {
        $this->nama = $nama;
        $this->harga = $harga;
    }
    // TODO: constructor (nama, harga)
    // TODO: override method tampilkanInfo()
}



// 4. ABSTRACTION
// Buat abstract class User dengan method abstract getRole()
// Buat class Admin dan Customer yang meng-extend User dan mengimplementasikan getRole()


abstract class User {
    protected $username;


    public function ˍˍˍˍconstruct($username) {
        $this->username = $username;
    }


    // TODO: buat abstract method getRole()
}


class Admin extends User {
    // TODO: implementasikan getRole()
}


class Customer extends User {
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
