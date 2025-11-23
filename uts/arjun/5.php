<?php
class lingkaran{
    public $jarijari;
    public $phi;

// constructor
    public function __construct($p, $l){
        $this->jarijari = $j;
        $this->phi = $p;
    }

    public function luas(){
        return $this->jarijari * $this->phi;
    }


}
$hasil = new persegipanjang(10, 5);
echo "Luas: " . $hasil->luas() . "\n";
echo "Keliling: " . $hasil->keliling() . "\n";
//output
// Luas: 50
// Keliling: 30