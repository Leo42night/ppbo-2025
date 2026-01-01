<?php
class Hewan {
    public $nama;
}

class Anjing extends Hewan {
    public function suara() {
        return " $this->nama! Guk Guk!";
    }
}

$anjing=new Anjing();
$anjing->nama="Heli";
echo $anjing->suara();
?>