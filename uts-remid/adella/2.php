<?php
class Hewan {
    public $nama;
    public $suara;

    public function suara() {
        return "$this->suara";
    }
}

class Anjing extends Hewan {
    public function suara() {
        return "Hewan anjing bernama $this->nama mempunyai suara $this->suara.";
    }
}

$anj = new Anjing();
$anj->nama = "Bobby";
$anj->suara = "Guk guk!";
echo $anj->suara();