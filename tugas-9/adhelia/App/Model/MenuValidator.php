<?php
namespace App\Model;

class MenuValidator {
    public static function validateHarga(int $harga): void {
        if ($harga < 0) {
            throw new HargaInvalidException("Harga tidak boleh negatif!");
        }
    }
}