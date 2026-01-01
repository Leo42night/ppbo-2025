<?php
class Hewan {
    public $nama;
}

class Anjing extends Hewan {
    public function suara() {
        return "Guk Guk!";
    }
}
$hewan = new Anjing();
echo $hewan->suara();
?>
