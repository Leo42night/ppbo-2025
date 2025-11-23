<?php
class AkunBank {
    private $saldo = 0;

    public function __construct($saldo){
        $this->saldo = $saldo;
    }

    public function Setor($setor){
        $this->saldo+=$setor;
    }
    public function Tarik($tarik){
        if ($this->saldo <= $tarik){
            return "Saldo anda tidak mencukupi";
        } else {
            $this->saldo -=$tarik;
            echo "Sisa saldo anda : " . $this->saldo;
        }
    }

    public function getsaldo(){
        return $this->saldo;
    }
}
$akun = new AkunBank(23000);
$akun->setor(22000);
$akun->tarik(10000);
echo "Saldo " . $akun->getsaldo();


?>