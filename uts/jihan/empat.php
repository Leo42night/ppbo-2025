// 1. ENCAPSULATION
// Buat class Produk dengan atribut: nama, harga (gunakan access modifier yang sesuai)
// Lengkapi constructor, setter, dan getter
// buat method umum: tampilkanInfo() dengan build in function number_format() untuk format harga
<?php
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
    public function getHarga() {
        return $this->harga;
    }

    public function tampilkanInfo() {
        echo "Harga: " . $this->harga . "15200\n";
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
        $this->nama = $nama;
        $this->harga = $harga;
        $this->penulis = $penulis;
    }

    // TODO: override method tampilkanInfo()
   public function tampilkanInfo() {
        echo "Penulis: " . $this->penulis . "jihan\n";
    }
}

// 3. POLYMORPHISM
// Buat class Elektronik yang juga mewarisi dari Produk
// Override method tampilkanInfo() dengan cara berbeda dari INHERITANCE (pakai __construct)

class Elektronik extends Produk {
    // TODO: constructor (nama, harga)
    public function __construct($nama, $harga) {
        $this->nama = $nama;
        $this->harga = $harga;
    }
    // TODO: override method tampilkanInfo()
     public function tampilkanInfo() {
        echo "Elektronik: " . $this->elektronik . "blender\n";
    }
}



// 4. ABSTRACTION
// Buat abstract class User dengan method abstract getRole()
// Buat class Admin dan Customer yang meng-extend User dan mengimplementasikan getRole()


abstract class User {
    protected $username;
    public function __construct($username){
        $this->username = $username;
    }
    // TODO: buat abstract method getRole()
    public function getRole() {
        return "admin" {$this-_;}
    }


class Admin extend User {
    // TODO: implementasikan getRole()
}


class Customer extend User {
    // TODO: implementasikan getRole()
}
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
output yang diharapkan:

Buku: Pemrograman PHP, Penulis: Budi, Harga: Rp 80.000
Elektronik: Laptop, Harga Spesial: Rp 7.000.000
Admin: Leo
Customer: Andi
