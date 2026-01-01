<?php
class AkunBank {
    protected $saldo;
    protected $tarik;
    
    

public function __construct($saldo) {
   $this->saldo = $saldo;
}

public function setor($jumlah) {
       $this->saldo += $jumlah;
       echo "Berhasil setor Rp $jumlah";
       echo "\n";
    }

public function tarik($jumlah){
    if ($jumlah > $this->saldo) {
        echo "Saldo kurang untuk menarik Rp $jumlah";
        echo "\n";
        return 0;
    }
    $this->saldo -= $jumlah;
    echo "Berhasil menarik Rp $jumlah";
    echo "\n";
    return $jumlah;
}
public function getSaldo() {
    return "Jumlah saldo sekarang Rp {$this->saldo}";
}
}

$akun = new AkunBank(5000);
echo $akun->getSaldo();
echo "\n";

$akun->setor(10000);
$tarikan = $akun->tarik(2000);
echo "Nominal yang ditarik Rp $tarikan";
echo "\n";
echo $akun->getSaldo();
