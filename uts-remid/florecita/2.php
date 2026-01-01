<?php
class Hewan {
    protected $nama;

    public function __construct($nama) {
        $this->nama = $nama;
    }

    public function getNama() {
        return $this->nama;
    }
}

class Anjing extends Hewan {
    public function suara() {
        return $this->getNama() . " terdengar: Guk Guk!";
    }
}


$anjing = new Anjing("oddy");
echo $anjing->suara(); 
?>
