<?php
class AkunBank{
    private $saldo=0;

    public function setor($jumlah) {
        if ($jumlah > 0) {
            $this->saldo += $jumlah;
        }
    }

    public function tarik($jumlah) {
        if ($jumlah > 0 && $jumlah <= $this->saldo) {
            $this->saldo -= $jumlah;
        } else {
            echo "Saldo tidak mencukupi untuk melakukan tarik tunai\n";
        }
    }

    public function getSaldo() {
        return $this->saldo;
    }
}

$akun = new AkunBank();
$akun->tarik(5000);
echo "Sisa saldo:" .$akun->getSaldo();