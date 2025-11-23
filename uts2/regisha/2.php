<?php

class Hewan{
    public $nama;
}

class Anjing extends Hewan{
    public function suara() {
    return "nama anjing adalah $this->nama selalu menggonggong berbunyi Guk Guk!";
}
}

$he1 = new Anjing();
$he1->nama="cihuahua";
echo $he1->suara();
?>