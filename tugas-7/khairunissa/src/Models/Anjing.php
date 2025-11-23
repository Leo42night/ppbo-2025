<?php
namespace AdopsiHewan\Models;

// 4. Inheritance: extends, override method, parent::
class Anjing extends Hewan {
    use \AdopsiHewan\Traits\PencatatTrait; // 10. Trait
    
    private string $tingkatEnergi;

    public function __construct(string $nama, int $umurBulan, string $ras, string $tingkatEnergi) {
        parent::__construct($nama, $umurBulan, $ras);
        $this->tingkatEnergi = $tingkatEnergi;
        $this->log("Anjing '{$nama}' dengan ras '{$this->ras}' terdaftar.");
    }

    // Override abstract method dari class Hewan
    public function bersuara(): string {
        // Menggunakan properti protected dari parent
        return $this->nama . " dari ras " . $this->ras . " bersuara: GUK GUK!";
    }
    
    // Override method __destruct dari parent
    public function __destruct() {
        // 3. Magic Methods: __destruct()
        // echo "Data Anjing '{$this->nama}' dihapus dari memori.\n";
    }

    // 7. Final Keyword: final function
    final public function tampilkanEnergi(): string {
        return "Tingkat Energi: {$this->tingkatEnergi}.";
    }

    // 3. Magic Methods: __toString()
    public function __toString(): string {
        return "Detail Anjing: {$this->nama}, Ras: {$this->ras}, " . $this->tampilkanStatus();
    }
    
    // 6. Late Static Binding: Perbedaan self:: vs static::
    public static function getKategori(): string {
        return "Kategori: " . static::class . " (Static Binding)";
    }
}