<?php

class Hewan {
    public $nama;

    public function __construct($nama){
        $this->nama = $nama;
    }

    public function suara(){
        echo "suara nya" . "\n";
    }

}

class Anjing Extends Hewan {

    Public function __construct($nama){
        parent::__construct($nama);
        echo "Nama nya adalah" ."<br>". $this->nama. "\n";
    }
    public function suara(){
    parent::suara();
    echo "GUK-GUK!";
    }
}

$anjing1= new Anjing("mimi");
echo $anjing1->suara()


?>
