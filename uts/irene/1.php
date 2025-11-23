<?php
class AkunBank {
    protected $saldo;
    public $tarik;
    
    public function setor() {
        return $this->saldo;
    }

public function __construct($saldo) {
    $this->saldo= $saldo;
}

public function getSaldo() {
    return "Jumlah saldo sekarang {$this->saldo}";
}
}

$akun = new AkunBank(5000);
$akun->tarik = -5000;
echo $akun->getSaldo();
