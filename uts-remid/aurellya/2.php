<?php
class Hewan {
    public $nama;

    public function __construct($nama) {
        $this->nama = $nama;
    }
}

class Anjing extends Hewan {
    public function suara() {
        return $this->nama . " menggonggong : Guk Guk!";
    }
}

$anjing1 = new Anjing("Juna");
echo $anjing1->suara();
?>