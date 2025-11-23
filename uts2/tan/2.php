<?php

class Hewan {
    public $nama;  
}

class Anjing extends Hewan {  
    public function __construct($nama) {
        $this->nama = $nama;  
    }
    
    public function suara() {
        return "Anjing bernama " . $this->nama . " mengeluarkan suara: Guk Guk!";  
    }
}

$anjing = new Anjing("Dugi");  

echo $anjing->suara();  
?>
