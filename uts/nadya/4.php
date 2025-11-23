<?php


// 1. ENCAPSULATION
// Buat class Produk dengan atribut: nama, harga (gunakan access modifier yang sesuai)
// Lengkapi constructor, setter, dan getter
// buat method umum: tampilkanInfo() dengan build in function number_format() untuk format harga


class Produk {
    private $nama; // isi atribut private $nama, $harga
    private $harga;


    public function __construct($nama, $harga){
        $this->nama = $nama;
        $this->harga = $harga;
    }  //buat constructor dengan parameter ($nama, $harga)

    public function getnama($nama){
        return $this->nama;
    }

    public function setharga($harga){
        if ($this->harga<0){
            throw new Exception("Harga Tidak Boleh Negatif");
        }
        return $this->harga=$harga;
    }

    public function getharga(){
        return $this->harga;
    }// buat getter dan setter untuk masing-masing atribut

    public function tampilkaninfo(){
        return "Nama : " . $this->nama . "Harga : Rp" . number_format($this->getharga(), 0, ",", ".");
    } // buat method umum: tampilkanInfo(), format harga menggunakan number_format() (15200 jadi 15.200)
}


class Buku Extends Produk{
    public $penulis;

    public function __construct($nama, $harga, $penulis){
        parent::__construct($nama, $harga);
        echo "Penulis : ". $this->penulis = $penulis;
    }

    public function tampilkaninfo(){
        parent::tampilkaninfo();
    }
}
// 2. INHERITANCE
// Buat class Buku yang mewarisi dari Produk
// Tambahkan atribut baru: penulis
// Override method tampilkanInfo()



// 3. POLYMORPHISM
// Buat class Elektronik yang juga mewarisi dari Produk
// Override method tampilkanInfo() dengan cara berbeda dari INHERITANCE (pakai __construct)


class Elektronik extends Produk {
    public function __construct($nama, $harga){
        // parent::tampilkaninfo();
    }
    //constructor (nama, harga)
    //override method tampilkanInfo()
}

// 4. ABSTRACTION
// Buat abstract class User dengan method abstract getRole()
// Buat class Admin dan Customer yang meng-extend User dan mengimplementasikan getRole()


abstract class User {
    protected $username;


    public function __construct($username) {
        $this->username = $username;
    }

    abstract public function getRole();//buat abstract method getRole()
}


class Admin Extends User {
    public function getRole(){
        echo "Role : Admin";
    }
    // TODO: implementasikan getRole()
}


class Customer Extends User {
    public function getRole(){
    echo "Role : Admin";
    }
}//implementasikan getRole()



// MAIN PROGRAM
$buku1 = new Buku("Pemrograman PHP", 80000, "Budi");
$elektronik1 = new Elektronik("Laptop", 7000000);

echo $buku1->tampilkanInfo() . "\n";
echo $elektronik1->tampilkanInfo() . "\n";

$admin = new Admin("Leo");
$customer = new Customer("Andi");


echo $admin->getRole() . "<br>";
echo $customer->getRole() . "<br>";