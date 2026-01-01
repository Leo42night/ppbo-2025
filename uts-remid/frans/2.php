<?php
class Hewan {
    public $nama;

    public function __construct($nama) {
        $this->nama = $nama;
    }
}

class Anjing extends Hewan {
    public function suara() {
        return $this->nama . " berkata: Guk Guk!";
    }
}

$anjing = new Anjing("Buddy");
echo $anjing->suara();