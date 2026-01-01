<?php
class Hewan {
    public function nama() {
        return "nama: ";
    }
    public function suara() {
        return "suara: ";
    }
}

class Anjing extends hewan{
    public function nama() {
        return parent::nama() . "asabyl";
    }
    public function suara() {
        return parent::suara() . "Guk-guk";
    }
}

$nama = new Anjing();
echo $nama->nama();
$suara = new Anjing();
echo $suara->suara();
