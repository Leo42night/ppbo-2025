<?php
namespace Core;

abstract class Produk implements ProdukInterface {
    protected string $nama;
    private float $harga;
    public static int $totalProduk = 0;
    public const PAJAK = 0.1;

    public function __construct(string $nama, float $harga) {
        $this->nama = $nama;
        $this->setHarga($harga);
        static::$totalProduk++; // Late static binding
    }

    public function setHarga(float $harga) {
        if ($harga < 0) throw new \Exception("Harga tidak boleh negatif!");
        $this->harga = $harga;
    }

    public function getHarga(): float {
        return $this->harga;
    }

    public static function hitungPajak(float $harga): float {
        return $harga * self::PAJAK;
    }

    abstract public function info(): string;

    // Magic methods
    public function __toString(): string { return $this->info(); }
    public function __call($name, $args) { return "Method '$name' tidak ada."; }
}
