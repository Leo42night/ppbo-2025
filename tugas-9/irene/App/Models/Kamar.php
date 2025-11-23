<?php
namespace App\Models;

use Exception;

class Kamar {
    const STATUS_TERSEDIA = 'tersedia';
    const STATUS_DIBOOKING = 'dipesan';

    private string $tipe;
    private float $harga;
    private string $status = self::STATUS_TERSEDIA;
    public static int $totalKamar = 0;

    public function __construct(string $tipe, float $harga) {
        $this->tipe = $tipe;
        $this->harga = $harga;
        self::$totalKamar++;
    }

    public function pesan(): void {
        if ($this->status === self::STATUS_DIBOOKING) {
            throw new Exception("Kamar sudah dipesan!");
        }
        $this->status = self::STATUS_DIBOOKING;
    }

    public function getHarga(): float {
        return $this->harga;
    }

    public function __get($property) {
        return $this->$property ?? null;
    }
}

