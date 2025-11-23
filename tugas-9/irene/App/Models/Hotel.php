<?php
namespace App\Models;

use App\Traits\Loggable;
use IteratorAggregate;
use ArrayIterator;

class Hotel implements IteratorAggregate {
    use Loggable;

    private string $nama;
    private string $lokasi;
    protected array $kamar = [];

    public function __construct(string $nama, string $lokasi) {
        $this->nama = $nama;
        $this->lokasi = $lokasi;
    }

    public function tambahKamar(Kamar $kamar): void {
        $this->kamar[] = $kamar;
    }

    public function getIterator(): ArrayIterator {
        // Object Iteration
        return new ArrayIterator($this->kamar);
    }

    public function __toString(): string {
        return "Hotel: {$this->nama}, Lokasi: {$this->lokasi}";
    }
}

