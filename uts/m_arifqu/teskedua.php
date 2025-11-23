<?php
class Hewan {
    protected $nama;
    public function __construct($nama) {
        $this->nama = $nama;
    }
}
class Anjing extends Hewan {
    public function suara() {
        return $this->nama . " bersuara: Guk Guk!";
    }
}
$anjingPeliharaan = new Anjing("Doggy");
echo $anjingPeliharaan->suara(); 
?>