<?php
class hewan{
    public $nama;
    public function suara() {
        return "Guk Guk!";
}
}
class Anjing extends hewan{
    public function tampilhewan() {
        return "hewan $this->nama";
    }
}
$kucing = new Anjing();
$kucing->nama="Kucing";
echo $kucing->tampilhewan();
echo"<br>";
echo $kucing->suara();