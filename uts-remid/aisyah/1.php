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
            echo "Saldo tidak cukup.<br>";
        }
    }

    public function getSaldo() {
        return $this->saldo;
    }
}

$akun = new AkunBank();
echo "Saldo: " . $akun->getSaldo() . "\n";
$akun->setor(10000) ;
echo "Saldo: " . $akun->getSaldo() . "\n";
$akun->tarik(5000);
echo "Saldo: " . $akun->getSaldo() . "\n";
?>