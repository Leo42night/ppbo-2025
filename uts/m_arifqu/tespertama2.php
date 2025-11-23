<?php

class AkunBank {
    private $saldo = 0;

    public function setor($jumlah) {
        if ($jumlah > 0) {
            $this->saldo += $jumlah;
            echo "Setoran berhasil. Saldo kamu sekarang: " . $this->getSaldo() . "\n";
        } else {
            echo "Jumlah setoran tidak valid.\n";
        }
    }

    public function tarik($jumlah) {
        if ($jumlah > 0 && $jumlah <= $this->saldo) {
            $this->saldo -= $jumlah;
            echo "Penarikan berhasil. Saldo Kamu sekarang: " . $this->getSaldo() . "\n";
        } else {
            echo "Penarikan gagal. Saldo tidak mencukupi atau jumlah tidak valid.\n";
        }
    }

    public function getSaldo() {
        return "Rp " . number_format($this->saldo, 0, ',', '.');
    }
}

$akun = new AkunBank();

echo "Saldo awal: " . $akun->getSaldo() . "\n";
$akun->setor(100000);
$akun->tarik(25000);
$akun->tarik(90000);
$akun->setor(-5000); 

?>
