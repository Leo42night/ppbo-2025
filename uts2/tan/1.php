<?php
class AkunBank {
    private $saldo = 0;  

    // Method setor
    public function setor($jumlah) {
        if ($jumlah > 0) {
            $this->saldo += $jumlah;
            echo "Setor berhasil: Saldo sekarang " . $this->getSaldo() . "\n";
        } else {
            echo "Error: Jumlah setor harus positif!\n";
        }
    }

    // Method tarik
    public function tarik($jumlah) {
        if ($jumlah > 0 && $jumlah <= $this->saldo) {
            $this->saldo -= $jumlah;
            echo "Tarik berhasil: Saldo sekarang " . $this->getSaldo() . "\n";
        } else {
            echo "Error: Saldo tidak cukup atau jumlah tarik tidak valid!\n";
        }
    }

    // Method getSaldo()
    public function getSaldo() {
        return $this->saldo;
    }
}


$akun = new AkunBank();


$akun->setor(10000);  
$akun->tarik(3000);   
$akun->tarik(8000);  
$akun->tarik(1000);   

echo "Saldo akhir: " . $akun->getSaldo();  // Tampilkan saldo akhir
?>

