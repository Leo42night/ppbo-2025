<?php
class AkunBank {
    private $saldo;
    private $sisa;
    public function setor(){
        return "Aku menambahkan saldo sebesar: ".$this->saldo = 5000 ;
    }
    public function tarik(){
        return "\nAku menarik saldo, sebesar 50, maka sisa saldo: ".$this->sisa = $this->saldo - 50;
    }
    public function getSaldo(){
        return "\nJumlah saldo direkening saat ini : ".$this->sisa;
    }        
}
$akun = new AkunBank();
echo $akun->setor();
echo $akun->tarik();
echo $akun->getSaldo();

?>