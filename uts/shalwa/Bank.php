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

// Contoh penggunaan
$akun = new AkunBank();
$akun->setor(10000);
$akun->tarik(5000);
echo "Saldo: " . $akun->getSaldo();
?>