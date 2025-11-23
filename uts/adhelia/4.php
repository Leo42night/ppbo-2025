<?php
class Produk
{
    private $nama;
    private $harga;

    public function __construct($nama, $harga)
    {
        $this->nama = $nama;
        $this->harga = $harga;
    }
    protected function getNama()
    {
        return "Nama = $this->nama";
    }

    protected function getHarga()
    {
        return "Harga = $this->harga";
    }

    public function setNama()
    {
        return $this->getNama();
    }

    public function setHarga()
    {
        return $this->getHarga();
    }

    public function tampilkanInfo()
    {
        return $this->setNama() . "\n" . $this->setHarga();
    }
}

// 2. INHERITANCE
// Buat class Buku yang mewarisi dari Produk
// Tambahkan atribut baru: penulis
// Override method tampilkanInfo()


class Buku extends Produk
{

    public $penulis;

    public function __construct($nama, $harga, $penulis)
    {
        $this->nama = $nama;
        $this->harga = $harga;
        $this->penulis = $penulis;
    }

    public function tampilkanInfo()
    {
        return "";
    }

}

// 3. POLYMORPHISM
// Buat class Elektronik yang juga mewarisi dari Produk
// Override method tampilkanInfo() dengan cara berbeda dari INHERITANCE (pakai __construct)


class Elektronik extends Produk
{
    public function __construct($nama, $harga)
    {
        $this->nama = $nama;
        $this->harga = $harga;
    }

    public function tampilkanInfo()
    {
        return "";
    }
}

// 4. ABSTRACTION
// Buat abstract class User dengan method abstract getRole()
// Buat class Admin dan Customer yang meng-extend User dan mengimplementasikan getRole()


abstract class User
{
    protected $username;
    abstract public function getRole();

    public function __construct($username)
    {
        $this->username = $username;
    }
}


class Admin extends User
{
    public function getRole()
    {
        return "";
    }
}

class Customer extends User
{
    public function getRole()
    {
        return "";
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

?>
Buku: Pemrograman PHP, Penulis: Budi, Harga: Rp 80.000
Elektronik: Laptop, Harga Spesial: Rp 7.000.000
Admin: Leo
Customer: Andi