<?php
class AkunBank {
    protected $saldo = 0;

    protected function getSaldo() {
        return "Jumlah sado anda adalah $this->saldo";
    }
    public function setSaldo($saldo) {
        $this->saldo = $saldo;
    }
    public function tampilkanSaldo() {
        return $this->getSaldo();
    }
    
$akun = new AkunBank();
$akun->saldo = -5000;
echo "Saldo: " . $akun->saldo;
}
?>


