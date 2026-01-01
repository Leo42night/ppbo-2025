<?php
class AkunBank {
    private $saldo;

    public function __construct($saldo) {
        $this->saldo = $saldo;
    }

    public function setor($jumlah) {
        $this->saldo += $jumlah;
    }

    public function tarik($jumlah) {
        if ($jumlah <= $this->saldo) {
            $this->saldo -= $jumlah;
            return "Saldo anda tersisa Rp. $this->saldo";
        } else {
            return "Saldo anda tidak cukup.";
        }
    }

    public function getSaldo() {
        return $this->saldo;
    }
}

$saldo = new AkunBank(0);
$saldo->setor(1200000);
$saldo->tarik(5000);
echo "\n";
echo "Lihat saldo: " . $saldo->getSaldo();