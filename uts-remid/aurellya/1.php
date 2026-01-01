<?php
class AkunBank {
    private $saldo = 0;

    public function setor($jumlah) {
        if ($jumlah > 0) {
            $this->saldo += $jumlah;
        }
    }

    public function tarik($jumlah) {
        if ($jumlah > 0 && $jumlah <= $this->saldo) {
            $this->saldo -= $jumlah;
        } else {
            echo "Saldo tidak cukup \n";
        }
    }

    public function getSaldo() {
        return $this->saldo;
    }
}

$akun = new AkunBank();
$akun->setor(15000);
$akun->tarik(5000);
echo "Saldo: " . $akun->getSaldo();
?>