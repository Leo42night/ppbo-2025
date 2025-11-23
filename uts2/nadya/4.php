<?php

// 1. ENCAPSULATION
// Class Produk dengan atribut private, constructor, setter-getter, dan method tampilkanInfo()

class Produk {
    private $nama;
    private $harga;

    // Constructor
    public function __construct($nama, $harga) {
        $this->nama = $nama;
        $this->setHarga($harga); // gunakan setter untuk validasi harga
    }

    // Getter dan Setter untuk nama
    public function getNama() {
        return $this->nama;
    }

    public function setNama($nama) {
        $this->nama = $nama;
    }

    // Getter dan Setter untuk harga
    public function getHarga() {
        return $this->harga;
    }

    public function setHarga($harga) {
        if ($harga < 0) {
            throw new Exception("Harga tidak boleh negatif!");
        }
        $this->harga = $harga;
    }

    // Method umum untuk menampilkan info produk
    public function tampilkanInfo() {
        return "Nama: " . $this->nama . 
               " | Harga: Rp" . number_format($this->harga, 0, ",", ".");
    }
}


// 2. INHERITANCE
// Class Buku mewarisi dari Produk dan menambahkan atribut baru (penulis)

class Buku extends Produk {
    private $penulis;

    public function __construct($nama, $harga, $penulis) {
        parent::__construct($nama, $harga);
        $this->penulis = $penulis;
    }

    // Override method tampilkanInfo()
    public function tampilkanInfo() {
        return parent::tampilkanInfo() . 
               " | Penulis: " . $this->penulis;
    }
}


// 3. POLYMORPHISM
// Class Elektronik juga mewarisi dari Produk tapi menampilkan info dengan format berbeda

class Elektronik extends Produk {
    public function __construct($nama, $harga) {
        parent::__construct($nama, $harga);
    }

    // Override method tampilkanInfo() dengan gaya berbeda
    public function tampilkanInfo() {
        return "[ELEKTRONIK] " . strtoupper($this->getNama()) .
               " seharga Rp" . number_format($this->getHarga(), 0, ",", ".");
    }
}


// 4. ABSTRACTION
// Abstract class User dengan abstract method getRole()
// Lalu class Admin dan Customer yang mengimplementasikan getRole()

abstract class User {
    protected $username;

    public function __construct($username) {
        $this->username = $username;
    }

    abstract public function getRole();
}

class Admin extends User {
    public function getRole() {
        return "User: " . $this->username . " | Role: Admin";
    }
}

class Customer extends User {
    public function getRole() {
        return "User: " . $this->username . " | Role: Customer";
    }
}


// MAIN PROGRAM
try {
    $buku1 = new Buku("Pemrograman PHP", 80000, "Budi");
    $elektronik1 = new Elektronik("Laptop", 7000000);

    echo $buku1->tampilkanInfo() . "\n";
    echo $elektronik1->tampilkanInfo() . "<br><br>";

    $admin = new Admin("Leo");
    $customer = new Customer("Andi");

    echo $admin->getRole() . "\n";
    echo $customer->getRole() . "\n";

} catch (Exception $e) {
    echo "Terjadi kesalahan: " . $e->getMessage();
}

?>
