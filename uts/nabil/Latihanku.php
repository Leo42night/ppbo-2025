<?php
//No 1
class AkunBank {
    private $saldo;
    private $sisa;
    public function setor(){
        return "Aku menambahkan saldo sebesar: ".$this->saldo = 5000 ;
    }
    public function tarik(){
        return "\nAku menarik saldo, sebesar 50, maka sisa saldo: ".$this->sisa = $this->saldo - 50;
    }
    public function getSaldo(){
        return "\nJumlah saldo direkening saat ini : ".$this->sisa;
    }        
}
$akun = new AkunBank();
echo $akun->setor();
echo $akun->tarik();
echo $akun->getSaldo();

?>

<?php
//No 2
class Hewan {
    public $nama;
}

class Anjing extends Hewan {
    public function suara() {
        return " $this->nama! Guk Guk!";
    }
}

$anjing=new Anjing();
$anjing->nama="Heli";
echo $anjing->suara();

//No 3
class Kendaraan {
    public function jalan(){
        echo "Kendaraan sedang berjalan";
    }
}

class Mobil extends Kendaraan{
    public function jalan() {
        return "Mobil sedang berjalan di jalan raya";
    }
}


class Motor extends Kendaraan{
    public function jalan() {
        return "Motor berjalan di jalan raya";
    }
}

$kendaraan1 = new Mobil();
$kendaraan2 = new Motor();

echo "\n=== OUTPUT HASIL ===\n";
echo "1. " . $kendaraan1->jalan() . "\n";
echo "2. " . $kendaraan2->jalan() . "\n";


//No 4
// 1. ENCAPSULATION
// Buat class Produk dengan atribut: nama, harga (gunakan access modifier yang sesuai)
// Lengkapi constructor, setter, dan getter
// buat method umum: tampilkanInfo() dengan build in function number_format() untuk format harga


class Produk {
    // TODO: isi atribut private $nama, $harga
    private $nama;
    private $harga;
    // TODO: buat constructor dengan parameter ($nama, $harga)
    public function __construct($nama,$harga){
        $this->nama = $nama;
        $this->harga = $harga;
    }
    // TODO: buat method umum: tampilkanInfo(), format harga menggunakan number_format() (15200 jadi 15.200)
    public function tampilkanInfo(){
        echo "Nama Produk $this->nama";
    }
    public function number_format(){
        echo "Harga Produk $this->harga";
    }
    // TODO: buat getter dan setter untuk masing-masing atribut

}



// 2. INHERITANCE
// Buat class Buku yang mewarisi dari Produk
// Tambahkan atribut baru: penulis
// Override method tampilkanInfo()


class Buku extends Produk {
    public $penulis;
    public function __construct($nama,$harga,$penulis){
        $this->nama = $nama;
        $this->harga = $harga;
        $this->penulis = $penulis;
    }
    public function tampilkanInfo(){
        echo "Buku: $this->nama\n";
        echo "Harga: $this->harga\n";
        echo "Penulis: $this->penulis\n";

    // TODO: buat atribut $penulis


    // TODO: buat constructor (nama, harga, penulis)


    // TODO: override method tampilkanInfo()
}
}



// 3. POLYMORPHISM
// Buat class Elektronik yang juga mewarisi dari Produk
// Override method tampilkanInfo() dengan cara berbeda dari INHERITANCE (pakai __construct)


class Elektronik extends Produk{
    public function __construct($nama,$harga){
        $this->nama = $nama;
        $this->harga = $harga;
    }
    public function tampilkanInfo()
    {
        echo "Elektronik: $this->nama\n";
        echo "Harga: $this->harga\n";
    }
    // TODO: constructor (nama, harga)
    // TODO: override method tampilkanInfo()
}



// 4. ABSTRACTION
// Buat abstract class User dengan method abstract getRole()
// Buat class Admin dan Customer yang meng-extend User dan mengimplementasikan getRole()


abstract class User {
    protected $username;
    abstract function getRole();
    public function __construct($username) {
        $this->username = $username;
    }


    // TODO: buat abstract method getRole()
}


class Admin extends User {
    public function getRole(){
        echo "Admin: $this->username\n";
    }
    // TODO: implementasikan getRole()
}


class Customer extends User {
    public function getRole(){
        echo "Customer: $this->username\n";
    }
    // TODO: implementasikan getRole()
}


// MAIN PROGRAM
$buku1 = new Buku("Pemrograman PHP", 80000, "Budi");
$elektronik1 = new Elektronik("Laptop", 7000000);

echo $buku1->tampilkanInfo() . "\n";
echo $elektronik1->tampilkanInfo() . "\n";

$admin = new Admin("Leo");
$customer = new Customer("Andi");


echo $admin->getRole();
echo $customer->getRole();


//No 5
class Matematika {
    const pi = "3.14";
    static $counter = 0;
    // TODO: buat konstanta PI dengan nilai 3.14
    // TODO: buat atribut static $counter untuk menghitung berapa kali method hitungLuasLingkaran dipanggil


    // Method untuk menghitung luas lingkaran
    public static function hitungLuasLingkaran($r) {
        self::$counter + 1;
        return $r * $r * self::pi;
        // TODO: tambahkan counter setiap kali method dipanggil
        // TODO: gunakan konstanta PI untuk menghitung luas lingkaran
    }


    // Method untuk menampilkan berapa kali method dipanggil
    public static function getCounter() {
        echo self::$counter;
        // TODO: kembalikan nilai $counter
    }
}


// MAIN PROGRAM


// Panggil method hitungLuasLingkaran beberapa kali tanpa membuat objek
echo "Luas lingkaran (r=7): " . Matematika::hitungLuasLingkaran(7) . "\n";
echo "Luas lingkaran (r=10): " . Matematika::hitungLuasLingkaran(10) . "\n";


// Tampilkan berapa kali method sudah dipanggil
echo "Method hitungLuasLingkaran dipanggil sebanyak: " . Matematika::getCounter() . " kali\n";


//No 7
class Kamar{
    public $nomorKamar;
    public $tipeKamar;
    protected $harga;
}
class Tamu{
    public $nama;
    public $idTamu;
}
class Reservasi extends Kamar{
    public $nomorKamar;
    public $nama;
    public $harga;
    public $persen;
    static $counter = 0;
    public function hitungTotalBiaya($malam){
        self::$counter + 1;
        if ($this->tipeKamar == "suite"){
            return $this->persen = $this->harga * 0.2;
        }
        elseif ($this->tipeKamar == "deluxe"){
            return $this->persen = $this->harga * 0.5;
        }
        echo $this->harga + $this->persen * $malam;
    }

}
$reservasi=new Reservasi();
$reservasi->nama="Budi";
$reservasi->harga=1000;
$reservasi->tipeKamar="suite";
$reservasi->hitungTotalBiaya(3);
?>

