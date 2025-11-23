<?php
class AkunBank {
    private $saldo = 0 ;

    public function saldo($amount) {
        if ($amount > 0) $this->saldo += $amount;
    }

    public function getSaldo() {
        return $this->saldo;
    }
}

$akun = new AkunBank();
$akun->saldo(2000000);
echo $akun->getSaldo(); 
