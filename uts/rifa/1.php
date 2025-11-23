<?php
class AkunBank {
    private $saldo = 0;

    public function setor($jumlah) {
        if ($jumlah > 0){
            $this->saldo += $jumlah;
        }
    }
    public function tarik($jumlah) {
        if ($jumlah > 0 && $jumlah <= $this->saldo){
            $this->saldo -= $jumlah;
        }
        else {  
            echo "saldo tidak cukup";
        }
    } 
    public function getSaldo() {
        return $this->saldo;
    }
}

$akun = new AkunBank();
$akun->setor(jumlah: 20000);
$akun->tarik(jumlah: 5000);
echo "saldo : ". $akun->getSaldo();

?>