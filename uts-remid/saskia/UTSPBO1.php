<?php
class AkunBank {
    private $saldo = 0;

    public function  Tarik($uang) {
        if ($this->saldo >= $uang) {
            $this->saldo -= $uang;
        } else {
            echo "saldo tidak cukup";
        }
    }
    public function setor($uang) {
        return $this->saldo += $uang;
    }
    public function getSaldo() {
        return $this->saldo ;
    }

}
$akun = new AkunBank();
$akun->setor(2000000);
echo "Saldo: " . $akun->getSaldo();
