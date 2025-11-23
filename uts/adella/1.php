<?php
class AkunBank {
    private $saldo = 0;


    public function __construct($saldo) {
        $this->saldo = $saldo;
    }


    public function setor($jumlah) {
        $this->saldo += $jumlah;
    }


    public function tarik($jumlah) {
        if ($jumlah <= $this->saldo) {
            $this->saldo -= $jumlah;
            return "Saldo anda ada $this->saldo";
        } else {
            return "Saldo anda masih tidak berubah.";
        }
    }


    public function getSaldo() {
        return "Sisa saldo bersisa $this->saldo";
    }
}


$akun = new AkunBank(5000);
$akun->setor(80000);
echo $akun->tarik(30000);
echo "\n";
echo $akun->getSaldo();