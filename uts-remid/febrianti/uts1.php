<?php
class AkunBank {
    private $saldo = 0;

    public function setor($jumlah) {
        if ($jumlah>0) {
            $this->saldo += $jumlah;
            echo "Setor berhasil sejumlah: " .number_format($jumlah). "\n";
        } else {
            echo "jumlah setor harus lebih dari 0";
        }
    }
    public function tarik($jumlah) {
        if ($jumlah > 0 && $this->saldo >= $jumlah) {
            $this->saldo -= $jumlah;
            echo "Tarik berhasil sejumlah: " .number_format($jumlah). "\n";
        } else {
            echo "gagal, saldo tidak mencukupi atau jumlah penarikan tidak valid.\n";
        }
    }
    public function getSaldo() {
        return $this->saldo;
    }
}
$akun = new AkunBank();
echo "Saldo awal: ". number_format($akun->getSaldo()). "\n";
$akun->setor(500000);
echo "saldo saat ini: ". number_format($akun->getSaldo()). "\n";
$akun->tarik(100000);
echo "saldo saat ini: ". number_format($akun->getSaldo()). "\n";

$akun->tarik(500000);
echo "saldo akhir: " .number_format($akun->getSaldo()). "\n";
?>