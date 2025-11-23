<?php
class AkunBank {
    public $saldo = 0;

    public function setor($jumlah) {
        if ($jumlah > 0) {
            $this->saldo += $jumlah; 
        }
    }
    public function tarik($jumlah) {
        if ($jumlah > 0 && $jumlah <= $this->saldo) {
            
        }
        else{
            echo "saldo tidak cukup";
        }
    }
    public function getSaldo() {
        return $this->saldo;
    }
}

$akun = new AkunBank();
$akun->setor(jumlah: 1000000);
$akun->tarik(jumlah: 5000);
echo "Saldo: " . $akun->saldo;