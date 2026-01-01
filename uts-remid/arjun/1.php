<?php
class AkunBank {
    private $saldo = 0;

    public function setor(int $jumlah) {
        if ($jumlah > 0) {
            $this->saldo += $jumlah;
        }
    }

    public function tarik(int $jumlah) {
        if ($jumlah > 0 && $this->saldo >= $jumlah) {
            $this->saldo -= $jumlah;
        }
    }

    public function getSaldo(): int {
        return $this->saldo;
    }
}

$akunBudi = new AkunBank();

echo "Saldo awal: " . $akunBudi->getSaldo() . "\n";
$akunBudi->setor(500000);
echo "Setelah setor 500.000, saldo sekarang: " . $akunBudi->getSaldo() . "\n";
$akunBudi->tarik(150000);
echo "Setelah tarik 150.000, saldo akhir: " . $akunBudi->getSaldo() . "\n";
?>