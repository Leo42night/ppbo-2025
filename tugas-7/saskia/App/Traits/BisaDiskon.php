<?php

namespace App\Traits;

trait BisaDiskon {
    private int $persenDiskon = 0;

    public function beriDiskon(int $persen): void {
        $this->persenDiskon = $persen;
    }
    
    public function getPersenDiskon(): int {
        return $this->persenDiskon;
    }

    protected function hitungHargaSetelahDiskon(int $hargaAwal): int {
        if ($this->persenDiskon > 0) {
            $potongan = $hargaAwal * ($this->persenDiskon / 100);
            return $hargaAwal - $potongan;
        }
        return $hargaAwal;
    }
}