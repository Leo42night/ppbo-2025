<?php
class Hewan {
    public $nama;
    public $warna;
    public $suara;

public function bersuara() {
    return " Beda hewan beda suara";
}
}

class  mamalia extends Hewan 
{
    public function suara() {
        return " nama hewan:{$this-> nama}, suara hewan tersebut: {$this->suara}";
    }
}

$hewan_mamalia = new mamalia ();
$hewan_mamalia->nama="anjing";
$hewan_mamalia->warna="Hitam";
$hewan_mamalia->suara="GUK GUK GUK";

echo $hewan_mamalia->suara();
?> 



