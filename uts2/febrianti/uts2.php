<?php
class Hewan{
    public $nama;
    public function __construct($nama) {
        $this->nama = $nama;
    }
}
class Anjing extends Hewan{
    public function suara() {
        return "{$this->nama} bersuara: Guk guk!";
    }
}
$hewan = new Anjing("Puppy");
echo $hewan->suara();
?>