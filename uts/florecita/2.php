
<!-- a.	Apa kesalahan konsep OOP pada kode di atas terkait inheritance?
b.	Perbaiki kode agar class Anjing merupakan turunan dari Hewan 
dan buatlah sebuah objek dari class tersebut dengan penentuan nama
ketika class di-instansiasi serta method suara() harus mengembalikan 
nama hewan dan suara. -->

<?php
class Hewan {
    protected $nama;

    public function __construct($nama) {
        $this->nama = $nama;
    }

    public function getNama() {
        return $this->nama;
    }
}

class Anjing extends Hewan {
    public function suara() {
        return $this->getNama() . " terdengar: Guk Guk!";
    }
}


$anjing = new Anjing("oddy");
echo $anjing->suara(); 
?>
