<?php
class AkunBank {
    protected $saldo;
    
    public function setor($saldo) {
        $this->saldo = $saldo;
    }
    public function tarik($saldo) {
        $this->saldo = $saldo;
    }
    protected function getSaldo() {
        return "Nilai saldo adalah $this->saldo";
    }
    public function tampilkanSaldo() {
        return $this->getSaldo();
    }

 
}
$akun1 = new AkunBank();
$akun1->setor(50000);
$akun1->tarik(25000);
echo $akun1->tampilkanSaldo();
?>