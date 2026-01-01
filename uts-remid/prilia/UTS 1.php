<?php
class AkunBank {
    private $saldo = 0;

    public function setor($jumlah) {
        if ($jumlah > 0) {
            $this->saldo += $jumlah;
            echo "Berhasil setor Rp{$jumlah}." . PHP_EOL;
        } else {
            echo "Jumlah setor harus lebih dari 0." . PHP_EOL;
        }
    }

    public function tarik($jumlah) {
        if ($jumlah > 0 && $jumlah <= $this->saldo) {
            $this->saldo -= $jumlah;
            echo "Berhasil tarik Rp{$jumlah}." . PHP_EOL;
        } else {
            echo "Saldo tidak mencukupi atau jumlah tidak valid." . PHP_EOL;
        }
    }

    public function getSaldo() {
        return $this->saldo;
    }
}

$akun = new AkunBank();
$akun->setor(10000);
$akun->tarik(3000);

echo "Saldo saat ini: Rp" . $akun->getSaldo() . PHP_EOL;
