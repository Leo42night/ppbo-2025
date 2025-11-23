<?php
// 4. Inheritance, 1. Scope, 2. Encapsulation, 6. Late Static Binding, 8. Type Hinting
namespace PerpustakaanOOP\Model;

use PerpustakaanOOP\Model\AuditInterface;


// Abstract Class untuk Polymorphism (11)
abstract class AnggotaPerpustakaan {
    protected string $nama;

    public function __construct(string $nama) {
        $this->nama = $nama;
    }

    // Abstract method untuk Polymorphism (11)
    abstract public function peran(): string;
}

// Perbaikan: Class Pustakawan MENGIMPLEMENTASIKAN AuditInterface
class Pustakawan extends AnggotaPerpustakaan implements AuditInterface {
    private string $nip;
    
    // 6. Late Static Binding - Class Constant
    const ROLE = "Pustakawan"; 

    // 4. Override Method
    public function peran(): string { // 8. Return Types (string)
        return "Staf " . static::getRoleConstant(); // Menggunakan static::
    }

    // 6. Late Static Binding: Perbedaan self:: vs static::
    public static function getRoleConstant(): string {
        return static::ROLE; 
    }

    // 4. Override Method: __construct
    public function __construct(string $nama, string $nip) {
        parent::__construct($nama); // 4. Memanggil method parent
        $this->nip = $nip;
    }
    
    // 11. Implementasi method dari AuditInterface (Polymorphism)
    // Magic method __call() DIHAPUS dan diganti dengan method eksplisit ini.
    public function lakukanAudit(): string {
        return "Pustakawan {$this->nama} melakukan audit koleksi.";
    }

    // Catatan: Magic Method __call() DIBUANG agar tidak konflik dengan method lakukanAudit()
    // yang kini menjadi method eksplisit.
}

// Class turunan Pustakawan untuk Late Static Binding
class KepalaPerpustakaan extends Pustakawan {
    // 6. Late Static Binding - Constant di-override
    const ROLE = "Kepala Perpustakaan"; 
    
    // Catatan: Karena Pustakawan sudah mengimplementasikan lakukanAudit(),
    // KepalaPerpustakaan mewarisi implementasi AuditInterface.
}