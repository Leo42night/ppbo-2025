<?php

class Hewan {
    public $nama;

    public function __construct($nama) {
        $this->nama = $nama;
    }
}

class Anjing extends Hewan{
    public function suara() {
        return $this->nama . "Mengeluarkan suara Guk Guk!";
    }
}

$doggy = new Anjing("Shibuya ");
echo "Nama anjing ini adalah Shibuya!\n";
echo $doggy->suara();