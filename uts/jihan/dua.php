<?php
class Hewan {
    public $nama;
    public $suara;
}

class Anjing {
    public function __construct($nama) {
        $this->nama = $nama;
    }
}