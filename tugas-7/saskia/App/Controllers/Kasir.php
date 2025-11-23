<?php

namespace App\Controllers;

use App\Models\Pesanan;
use App\Services\Pencatat;
use Exception;

class Kasir {
    const PPN_RATE = 0.11; // PPN 11%
    public static int $totalPesanan = 0;

    private Pencatat $pencatat;

    public function __construct(Pencatat $pencatat) {
        $this->pencatat = $pencatat;
    }

    public function prosesPesanan(Pesanan $pesanan): array {
        if (count($pesanan->getItems()) === 0) {
            throw new Exception("Tidak bisa memproses pesanan kosong.");
        }

        $subtotal = $pesanan->hitungSubtotal();
        $ppn = $subtotal * self::PPN_RATE;
        $total = $subtotal + $ppn;

        $this->pencatat->catat("Pesanan diproses. Subtotal: {$subtotal}, Total: {$total}");
        self::$totalPesanan++;

        return ['subtotal' => $subtotal, 'ppn' => $ppn, 'total' => $total];
    }

    public static function getTotalPesananDiproses(): int {
        return self::$totalPesanan;
    }
}