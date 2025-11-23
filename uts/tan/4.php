<?php
//encapsulasi
class Produk {
    private $nama;
    private $harga;

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
        $this->harga = $harga;
    }

    public function tampilkanInfo() {
        return "Produk: {$this->nama}, Harga: Rp " . number_format($this->harga, 0, ',', '.');
    }
}

//inheritance
class Buku extends Produk {
    private $penulis;

    public function __construct($nama, $harga, $penulis) {
        parent::__construct($nama, $harga);
        $this->penulis = $penulis;
    }

    public function tampilkanInfo() {
        return "Buku: " . $this->getNama() . 
               ", Penulis: {$this->penulis}, Harga: Rp " . number_format($this->getHarga(), 0, ',', '.');
    }
}

// polymorphism
class Elektronik extends Produk {
    public function __construct($nama, $harga) {
        parent::__construct($nama, $harga);
    }

    public function tampilkanInfo() {
        return "Elektronik: " . $this->getNama() . 
               ", Harga Spesial: Rp " . number_format($this->getHarga(), 0, ',', '.');
    }
}

//abstaction
abstract class User {
    protected $username;

    public function __construct($username) {
        $this->username = $username;
    }

    abstract public function getRole();
}

class Admin extends User {
    public function getRole() {
        return "Admin: {$this->username}";
    }
}

class Pelanggan extends User {
    public function getRole() {
        return "Pelanggan: {$this->username}";
    }
}

$buku1 = new Buku("Pengusaha Sukses", 80000, "Yamsin");
$elektronik1 = new Elektronik("Tv", 7000000);

echo $buku1->tampilkanInfo() . "\n";
echo $elektronik1->tampilkanInfo() . "\n";

$admin = new Admin("Meka");
$Pelanggan = new Pelanggan("Asabil");

echo $admin->getRole() . "\n";
echo $Pelanggan->getRole() . "\n";
