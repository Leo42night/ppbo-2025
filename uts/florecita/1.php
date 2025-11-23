<?php
class AkunBank {
    private $saldo = 0;

    public function setor($jumlah) {
        if ($jumlah > 0) {
            $this->saldo += $jumlah;
        }
    }

    public function tarik($jumlah) {
        if ($jumlah > 0 && $this->saldo >= $jumlah) {
            $this->saldo -= $jumlah;
            return true;
        }
        return false;
    }


    public function getSaldo() {
        return $this->saldo;
    }
}

$saldo = new AkunBank();
$saldo->setor(1000);
$saldo->tarik(500);
echo "saldo anda sebanyak Rp." . $saldo->getSaldo();
