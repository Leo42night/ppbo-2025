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
    public function __construct($nama) {
        parent::__construct($nama);
    }

    public function suara() {
        return $this->nama . " berkata: Guk Guk!";
    }
}

// Contoh penggunaan
$anjing = new Anjing("Rocky");
echo $anjing->suara(); // Buddy berkata: Guk Guk!
?>
