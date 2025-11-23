＜?php
class AkunBank {
    public $saldo = 0；
}

$akun = new AkunBank();
$akun->saldo = -5000;
echo "Saldo: " . $akun->saldo;

