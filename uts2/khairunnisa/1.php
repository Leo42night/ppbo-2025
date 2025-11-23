<?php
class AkunBank 
{
    protected $saldo = 0;
    public $setor1 = 500000;
    
    public function setor()
            {
                return"Anda baru saja menyetorkan 500.000 \n" . $this->saldo + $this->setor1 = $this->saldo ;
            }

    public function tarik()
        {
            return"Tarik -100.000 \n";
        }
    public function getSaldo()
    {
        return $this->saldo;
        
    }
}

$akun = new AkunBank();
echo "Saldo saat ini: "  . $akun->getSaldo()."\n" ;
$akun->setor();
echo "Saldo saat ini: "  . $akun->getSaldo()."\n" ;
echo $akun->setor();
$akun->tarik();
echo $akun->tarik();
