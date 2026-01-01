<?php

class AkunBank {
    private $saldo = 0;

    public function setor($jumlah) {
        $this->saldo =+ $jumlah ;
    }

    public function tarik($jumlah) {
        if ($this->saldo >= $jumlah) {
            $this->saldo -= $jumlah;
        } else {
            echo "Saldo tidak cukup! \n";
        }
    }

    public function getSaldo() {
        return $this->saldo;
    }
}

$akun = new AkunBank();
$akun->setor(1000000);
echo "Saldo: " . $akun->getSaldo() . "\n";
$akun->tarik(50000);
echo "Saldo: " . $akun->getSaldo() ."\n";
