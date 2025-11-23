<?php
// 1. ENCAPSULATION
// Buat class Produk dengan atribut: nama, harga (gunakan access modifier yang sesuai)
// Lengkapi constructor, setter, dan getter
// buat method umum: tampilkanInfo() dengan build in function number_format() untuk format harga
class Produk {
    private $nama;
    private $harga;

    public function __construct($nama, $harga) {
        $this -> nama = $nama;
        $this -> harga = $harga;
    }

    public function getNama() {
        return "Nama Produk: $this->nama";
    }

    public function setNama($nama) {
        $this -> nama = $nama;
    }

    public function getHarga() {
        return "Harga Prduk: $this->harga";
    }

    public function setHarga() {
        $this -> harga = $harga;
    }

    public function tampilkanInfo() {
        echo $this -> getNama();
        echo "Rp " . number_format($this -> getHarga(), 0, ',', '.');
    }
}

// 2. INHERITANCE
// Buat class Buku yang mewarisi dari Produk
// Tambahkan atribut baru: penulis
// Override method tampilkanInfo()


class Buku extends Produk {
    public $penulis;

    public function __construct($nama, $harga, $penulis) {
        $this -> nama = $nama;
        $this -> harga = $harga;
        $this -> penulis = $penulis;
    }

    public function tampilkanInfo() {
        echo $this -> getNama();
        echo "Rp " . number_format($this -> getHarga(), 0, ',', '.');
    }
}


// 3. POLYMORPHISM
// Buat class Elektronik yang juga mewarisi dari Produk
// Override method tampilkanInfo() dengan cara berbeda dari INHERITANCE (pakai __construct)


class Elektronik extends Produk {
    public function __construct($nama, $harga) {
        $this -> nama = $nama;
        $this -> harga = $harga;
    }
    public function tampilkanInfo() {
        echo $this -> getNama();
        echo "Rp " . number_format($this -> getHarga(), 0, ',', '.');
    }
}

// 4. ABSTRACTION
// Buat abstract class User dengan method abstract getRole()
// Buat class Admin dan Customer yang meng-extend User dan mengimplementasikan getRole()

abstract class User {
    protected $username;

    public function __construct($username) {
        $this->username = $username;
    }

    abstract public function getRole();
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
echo $elektronik1->tampilkanInfo() . "\n";

//$admin = new Admin("Leo");
//$customer = new Customer("Andi");


//echo $admin->getRole() . "<br>";
//echo $customer->getRole() . "<br>";
