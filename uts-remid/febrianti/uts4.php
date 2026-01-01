<?php

// 4. ABSTRACTION
// Buat abstract class User dengan method abstract getRole()
// Buat class Admin dan Customer yang meng-extend User dan mengimplementasikan getRole()

abstract class User {
    protected $username;
    
    // Hanya sisakan satu constructor yang benar
    public function __construct($username) {
        $this->username = $username;
    }
    
    // Method abstract yang wajib diimplementasikan oleh kelas turunan
    abstract public function getRole();
}

class Admin extends User {
    // Implementasi ini sudah benar
    public function getRole() {
        return "Admin: {$this->username}";
    }
}

class Customer extends User {
    // Implementasi yang sudah diperbaiki
    public function getRole() {
        // KESALAHAN ADA DI SINI: Ubah "Admin" menjadi "Customer"
        return "Customer: {$this->username}";
    }
}

// MAIN PROGRAM
// (Kode dari soal nomor 1-3 tidak disertakan untuk fokus pada masalah)

$admin = new Admin("Leo");
$customer = new Customer("Andi");

echo $admin->getRole() . "\n";
echo $customer->getRole() . "\n";

?>
