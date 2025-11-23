<?php
// 11. Polymorphism (abstract class)
namespace AdopsiHewan\Models;

abstract class Hewan {
    // 1. Scope: public, private, protected
    public string $nama;
    private int $umurBulan; // Properti private
    protected string $ras;

    // 5. Class Constants
    const STATUS_ADOP = 'Siap Adopsi';

    // 2. Encapsulation (Mengakses properti private melalui method)
    public function __construct(string $nama, int $umurBulan, string $ras) {
        // 8. Type Hinting & Return Types
        $this->nama = $nama;
        $this->setUmur($umurBulan); // Menggunakan setter untuk kontrol
        $this->ras = $ras;
    }

    public function getUmurTahun(): float {
        return $this->umurBulan / 12;
    }

    private function setUmur(int $umur): void {
        if ($umur < 1) {
            // 9. Exception Handling
            throw new \InvalidArgumentException("Umur hewan harus minimal 1 bulan.");
        }
        $this->umurBulan = $umur;
    }
    
    // 12. Static Properties & Methods
    public static function getKategori(): string {
        return "Hewan Peliharaan";
    }

    // 3. Magic Methods: __call()
    public function __call($name, $arguments) {
        if ($name === 'tampilkanStatus') {
            return "Status: " . self::STATUS_ADOP . " | Umur: " . $this->getUmurTahun() . " tahun";
        }
        throw new \BadMethodCallException("Method '$name' tidak ada.");
    }

    public function getRas(): string {
    return $this->ras;
    }

    
    // Abstract method harus di-override di kelas turunan
    abstract public function bersuara(): string;
}