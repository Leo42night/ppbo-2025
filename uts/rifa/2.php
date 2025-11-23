<?php
class Hewan {
    public $nama;
    public function __construct($nama) {
        $this->nama = $nama;
    }
}

class Anjing extends hewan {
    public function suara() {
    return $this->nama. " berkata: guk";
    }
}

$anjing = new Anjing("inu");
echo $anjing->suara();
?>