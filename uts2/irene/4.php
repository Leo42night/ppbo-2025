<?php
class Produk {
    public $nama;
    protected $harga;
    public $penulis;

    public function tampilkanInfo($harga) {
        $this->harga = $harga;
    }

}

class Buku extends Produk{
    public function __construct($nama, $penulis, $harga) {
        $this->nama= $nama;
        $this->harga= $harga;
        $this->penulis= $penulis;
    }

    public function tampilInfo() {
        return "Buku: {$this->nama}, Penulis: {$this->penulis} Harga: {$this->harga}";
    }
}

class Elektronik extends Produk{
    public function __construct($nama, $harga) {
        $this->nama= $nama;
        $this->harga= $harga; 
    }

    public function tampilInfo() {
        return "Elektronik: {$this->nama}, Harga Spesial: {$this->harga}";
    }
}

abstract class User {
    protected $username;

    public function __construct($username) {
        $this->username = $username;
    }
    abstract public function getRole();
}

class Admin extends User{
    public function getRole() {
    return "Admin: $this->username";

    }
}

class Customer extends User {
    public function getRole() {
    return "Customer: $this->username";
    }
}

// MAIN PROGRAM
$buku1 = new Buku("Pemrograman PHP", "Budi", 80000);
$elektronik1 = new Elektronik("Laptop", 7000000);

echo $buku1->tampilInfo() . "\n";
echo $elektronik1->tampilInfo() . "\n";

$adm = new Admin ("Leo");
$customer2 = new Customer ("Andi");

echo $adm->getRole();
echo "\n";
echo $customer2->getRole();