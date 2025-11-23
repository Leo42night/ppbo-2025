<?php 
class Hewan {
    public $nama;
    public function __construct($nama) {
        $this->nama = $nama;
    }
}

class Anjing extends Hewan {

    public function suara() {
        return $this->nama .  " Bilang: Guk Guk!";
    }
}

$anjing = new Anjing("jihan");
echo $anjing->suara(); 
?>