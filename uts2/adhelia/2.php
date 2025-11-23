<?php
class Hewan {
    public $nama;
}

class Anjing extends Hewan {
    public function suara() {
        echo "$this->nama bersuara: guk guk";
    }
}
$anjing = new Anjing();
$anjing->nama = "Bunny";
$anjing->suara();
?>