?php
class AkunBank {
    public $saldo = 0
}

class Setor{
    protected $Setor="Setor Tunai"
    public function masukkan_saldo(){
        return $this->setor;
    }
    protected function Setor_tunai(){
        Return "Masukkan Jumlah Saldo";
    }
    public function masukkan_nominal() {
        return $this-> Masukkan_saldo() ;
    }
}

class tarik{
    protected $tarik="Tarik Tunai"
    public function Tarik_saldo(){
        return $this->Tarik;
    }
    protected function Tarik_tunai(){
        Return "Masukkan Jumlah Saldo yang Ditarik";
    }
    public function masukkan_nominal() {
        return $this-> Tarik_saldo() ;
    }
}

class getSaldo{
    protected $getSaldo="Tampilkan Saldo"
    public function tampilkan_saldo(){
        return $this->Tampilkan Saldo;
    }
    protected function Tampilkan_jumlah_saldo(){
        Return "Jumlah Saldo yang Ada";
    }
    public function Tampilkan_Total_Saldo() {
        return $this-> Tampilkan_Jumlah_saldo() ;
    }
}


$akun = new AkunBank();
$akun->saldo = -5000;
echo "Saldo: " . $akun->saldo;

