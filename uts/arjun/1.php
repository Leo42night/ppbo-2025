<?php
//buat class kendaraan
class AkunBank {
  // property dengan hak akses private
  private $saldo = -5000 ;
  public function get_saldo()
  {
    return $this->saldo;
  }
  public function tarik ()   
  {
    return $this->saldo;
  }

}

class andi extends AkunBank{
    private $saldo = 0;
}

$akun= new AkunBank();
$akun->$saldo= -5000;
echo "saldo:" .$akun->$saldo;