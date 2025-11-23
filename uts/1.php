<?php
class AkunBank {
    public $saldo = 0;

    public function setor($n) {
      $this->saldo += $n;
    }

    public function tarik($n) {
      $this->saldo -= $n;
    }

    public function getSaldo() {
      return $this->saldo;
    }
}

$akun = new AkunBank();
echo "Saldo: " . $akun->getSaldo();
$akun->setor(5000);
echo "\nSaldo: " . $akun->getSaldo();
$akun->tarik(2000);
echo "\nSaldo: " . $akun->getSaldo();