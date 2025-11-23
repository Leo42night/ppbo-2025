<?php
class Hewan {
    public $nama;
    public $suara;

    public function suara() {
        return "Suara hewan ini $this->suara";
    }
}

class Anjing extends Hewan {
    public function suara() {
         echo"Hewan bernama $this->nama, mengeluarkan suara $this->suara";
    }
}

$anjing = new Anjing();
$anjing->nama = "Monyet";
$anjing->suara = "Guk Guk";
echo $anjing->suara();