<?php
class Hewan {
    public $nama;
}
class Anjing extends Hewan {
    public $suara;
    
    function suara() {
        return "Si $this->nama mengeluarkan suara $this->suara";
    }
}

$ajg = new Anjing();
$ajg->nama = "Tom";
$ajg->suara ="woof-woof";
echo $ajg->suara();