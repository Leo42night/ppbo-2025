<?php
class Hewan {
    public $nama;
}

class Anjing extends Hewan{
    public function suara() {
        echo "Guk Guk!";
    }
}

$anjing1 = new Anjing();
$anjing1->nama = "Boby";
echo "Nama: $anjing1->nama";
echo "\n";
$anjing1->suara();

