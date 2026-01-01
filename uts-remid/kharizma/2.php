<?php
class Hewan {
    public $nama;

    public function __construct($nama) {
        $this->nama = $nama;
    }
}
class Anjing extends Hewan {
    public function suara() {
        return $this->nama . " menggonggong bunyinya guk guk guk!";
    }
}

$anjing1 = new Anjing("Anjing");
echo $anjing1->suara();