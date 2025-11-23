<?php
class Hewan {
    public $nama;

    public function __construct($nama) {
        $this->nama = $nama;
    }
}

class Anjing extends Hewan {
    public function suara() {
        return $this->nama . " bersuara Guk Guk!";
    }
}

$anjing1 = new Anjing("Doggy");
echo $anjing1->suara();
?>
