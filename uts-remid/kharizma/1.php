<?php
class AkunBank {
    private $saldo = 0;
    public $jumlah;

    public function setor($jumlah) {
        if ($jumlah > 0) {
            $this->saldo += $jumlah;
        }
    }

    public function tarik($jumlah) {
        if ($jumlah > 0 && $jumlah <= $this->saldo) {
            $this->saldo -= $jumlah;
        } else {
            echo "Saldo tidak mencukupi!\n";
        }
    }

    public function getSaldo() {
        return $this->saldo;
    }
    
}

$akun = new AkunBank();
$akun->setor(10000);
$akun->tarik(5000);
echo "Setor Saldo : 10000";
echo "\n";
echo "Tarik Saldo : 5000";
echo "\n";
echo "Saldo: " . $akun->getSaldo();