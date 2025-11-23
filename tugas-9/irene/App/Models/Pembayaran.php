<?php
namespace App\Models;

use App\Traits\Loggable;

class Pembayaran {
    use Loggable;

    protected float $jumlah;
    protected string $metode;

    public function __construct(float $jumlah, string $metode) {
        $this->jumlah = $jumlah;
        $this->metode = $metode;
    }

    public static function konfirmasi(): string {
        // Late Static Binding demo
        return static::class . " telah dikonfirmasi.";
    }

    public function proses(): string {
        $this->log("Proses pembayaran sebesar Rp{$this->jumlah} via {$this->metode}");
        return "Pembayaran berhasil.";
    }
}
