<?php
namespace App\Model;

use App\Contract\Pesanable;
use App\Traits\Loggable; 

class Menu implements Pesanable {
    use Loggable;

    // Class Constant
    public const PAJAK = 0.1;

    // Properties
    private string $nama;
    private int $harga;
    protected string $kategori;

    // Constructor (Magic Method)
    public function __construct(string $nama, int $harga, string $kategori) {
        $this->nama = $nama;
        $this->harga = $harga;
        $this->kategori = $kategori;
    }

    // Encapsulation (Getter & Setter)
    public function getNama(): string {
        return $this->nama;
    }

    public function getHarga(): int {
        return $this->harga;
    }

    public function setHarga(int $harga): void {
        $this->harga = $harga;
    }

    // Harga dengan pajak
    public function getHargaFinal(): int {
        return (int) ($this->harga + ($this->harga * self::PAJAK));
    }

    // Implementasi dari interface Pesanable
    public function pesan(): string {
        return "Memesan {$this->nama} seharga Rp{$this->getHargaFinal()}";
    }

    // Magic Methods
    public function __toString(): string {
        return "{$this->kategori} - {$this->nama} - Rp{$this->getHargaFinal()}";
    }

    public function __destruct() {
        echo "Objek {$this->nama} dihapus.\n";
    }

    public function __get($property) {
        return $this->$property ?? null;
    }

    public function __set($property, $value) {
        $this->$property = $value;
    }

    public function __call($name, $arguments) {
        $this->log("Method {$name} tidak ada. Argumen: " . implode(", ", $arguments));
    }
}
