<?php
// 1. ENCAPSULATION
class Produk {
    // Atribut private (enkapsulasi)
    private $nama;
    private $harga;

    // Constructor
    public function __construct($nama, $harga) {
        $this->nama = $nama;
        $this->harga = $harga;
    }

    // Getter dan Setter
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
        $this->harga = $harga;
    }

    // Method umum
    public function tampilkanInfo() {
        return "Nama Produk: {$this->nama}, Harga: Rp " . number_format($this->harga, 0, ',', '.');
    }
}

// 2. INHERITANCE
class Buku extends Produk {
    private $penulis;

    // Constructor (override)
    public function __construct($nama, $harga, $penulis) {
        parent::__construct($nama, $harga);
        $this->penulis = $penulis;
    }

    // Override method tampilkanInfo()
    public function tampilkanInfo() {
        return "Buku: {$this->getNama()}, Penulis: {$this->penulis}, Harga: Rp " . number_format($this->getHarga(), 0, ',', '.');
    }
}

// 3. POLYMORPHISM
class Elektronik extends Produk {
    public function __construct($nama, $harga) {
        parent::__construct($nama, $harga);
    }

    // Override tampilkanInfo dengan format berbeda
    public function tampilkanInfo() {
        return "Elektronik {$this->getNama()} dibanderol seharga Rp " . number_format($this->getHarga(), 0, ',', '.');
    }
}

// 4. ABSTRACTION
abstract class User {
    protected $username;

    public function __construct($username) {
        $this->username = $username;
    }

    // Abstract method
    abstract public function getRole();
}

class Admin extends User {
    public function getRole() {
        return "Admin: {$this->username}";
    }
}

class Customer extends User {
    public function getRole() {
        return "Customer: {$this->username}";
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
