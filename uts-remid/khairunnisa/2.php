<?php
class Hewan {
    public $nama= "Nuka";

}

class Anjing extends Hewan {
    public function suara() {
        return "Nama anjing tersebut adalah {$this->nama} \n" . "Guk Guk!";
    }
}

$anjing1= new Anjing();
echo $anjing1->suara();