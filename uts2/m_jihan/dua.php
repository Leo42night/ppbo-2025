<?php

class Hewan {
    public $nama;
}

class Anjing extends Hewan {
    public function __construct($nama) {
        $this->nama = $nama;
    }

    public function suara() {
        return $this->nama . " Guk Guk!";
    }
}

$anjing = new Anjing("Luca");

echo $anjing->suara();  
?>