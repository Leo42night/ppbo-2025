<?php
class Hewan {
    public $nama;
    public function suara() {
        return "Guk Guk!";
    }
}

class Anjing extends Hewan{
    public function tampilhewan() {
        return "hewan: $this->nama, " . $this->suara();
    }
} 

$anjing = new Anjing();
$anjing->nama="Ajing";
echo $anjing->tampilhewan();
echo $anjing->suara();


