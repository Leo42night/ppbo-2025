<?php
class Hewan {
    public function nama(){
        return "nama:";
    }
    public function suara(){
        return "suara:";
    }
}

class Anjing extends Hewan {
    public function nama(){
        return parent::nama()."Doggie";
    }
    public function suara() { 
        return parent::suara() . " GukGuk!"; 
    }
}

$nama = new Anjing();
echo $nama->nama();
$anjing = new Anjing();
echo $anjing->suara(); 