<?php

class Produk {
    private $nama;
    private $harga;

    public function __construct($nama, $harga) 
    {
        $this->nama = $nama;
        $this->harga = $harga;
    }

    public function getNama() {
        return $this->nama;
    }

    public function getHarga(){
        return $this->harga;
    }

    public function setNama($nama) {
        $this->nama = $nama;
    }
    
    public function setHarga($harga) {
        $this->harga = $harga;
    }

    public function tampilkanInfo() 
    {
        $harga_format = number_format($this->harga, 0, ',', '.');
        return "Produk: " . $this->nama . ", Harga: Rp " . $harga_format;
    }
}

class Buku extends Produk {
    private $penulis;

    public function __construct ($nama, $harga, $penulis)
    {
        parent::__construct($nama, $harga);
        $this->penulis = $penulis;
    }

    public function tampilkanInfo()
    {
        $harga_format = number_format($this->getHarga(), 0, ',', '.'); 
        return "Buku: " . $this->getNama() . ", Penulis: " . $this->penulis . ", Harga: Rp " . $harga_format;
    }
}

class Elektronik extends Produk {
    
    public function __construct ($nama, $harga)
    {
        parent::__construct($nama, $harga);
    }
    
    public function tampilkanInfo() 
    {
        $harga_format = number_format($this->getHarga(), 0, ',', '.');
        return "Elektronik: " . $this->getNama() . ", Harga Spesial: Rp " . $harga_format;
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
    public function getRole() {
        return "Admin: " . $this->username;
    }
}

class Customer extends User {
    public function getRole() {
        return "Customer: " . $this->username;
    }
}

$buku1 = new Buku("Pemrograman PHP", 80000, "Budi");
$elektronik1 = new Elektronik("Laptop", 7000000);

echo $buku1->tampilkanInfo() . "\n";
echo $elektronik1->tampilkanInfo() . "\n"; 

$admin = new Admin("Leo");
$customer = new Customer("Andi");


echo $admin->getRole() . "\n";
echo $customer->getRole() . "\n";