<?php


// 1. ENCAPSULATION
// Buat class Produk dengan atribut: nama, harga (gunakan access modifier yang sesuai)
// Lengkapi constructor, setter, dan getter
// buat method umum: tampilkanInfo() dengan build in function number_format() untuk format harga


class Produk {

    public $nama;
    public $harga;

    public function __construct($nama, $harga) {
        $this->nama = $nama;
        $this->harga = $harga;
    }

    public function getNama() {
        return $this->nama;
    }

    public function setNama($nama) {
        $this->nama = $nama;
    }

    public function getHarga() {
        return $this->harga;
    }

    public function setHarga($harga) {
        if ($harga >= 0) {
            $this->harga = $harga;
        }
    }
     public function tampilkanInfo() {
        return "Produk: " . $this->nama . ", Harga: Rp " . number_format($this->harga, 0, ',', '.');
    }
}
// 2. INHERITANCE
// Buat class Buku yang mewarisi dari Produk
// Tambahkan atribut baru: penulis
// Override method tampilkanInfo()


class Buku extends Produk {
    // TODO: buat atribut $penulis
    public $penulis;


    // TODO: buat constructor (nama, harga, penulis)
    public function __construct($nama, $harga, $penulis) {
        $this->nama=$nama;
        $this->harga=$harga;
        $this->penulis=$penulis;
        }

    // TODO: override method tampilkanInfo()
    public function tampilkanInfo() {
        return "Buku: " . $this->getNama() . ", Penulis: " . $this->penulis . ", Harga: Rp " . number_format($this->getHarga(), 0, ',', '.');
    }
}




// 3. POLYMORPHISM
// Buat class Elektronik yang juga mewarisi dari Produk
// Override method tampilkanInfo() dengan cara berbeda dari INHERITANCE (pakai __construct)


class Elektronik extends Produk {
    // TODO: constructor (nama, harga)
    // TODO: override method tampilkanInfo()
    public function __construct($nama, $harga) {
        parent::__construct($nama, $harga);
    }
    public function tampilkanInfo() {
        return "Elektronik: " . $this->getNama() . ", Harga Spesial: Rp " . number_format($this->getHarga(), 0, ',', '.');
    }
}
abstract class User {
    protected $username;

    public function __construct($username) {
        $this->username = $username;
    }
    abstract public function getRole();
}

class Admin extends User {
    // TODO: implementasikan getRole()
    public function getRole() {
        return "Admin: " . $this->username;
    }
}


class Customer extends User {
    // TODO: implementasikan getRole()
    public function getRole() {
        return "Customer: " . $this->username;
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
