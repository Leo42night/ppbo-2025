<?php
class Hewan {
    public $nama;

    public function __construct(string $nama) {
        $this->nama = $nama;
    }
}

class Anjing extends Hewan {
    public function suara(): string {
        return "{$this->nama} bersuara: Guk Guk!";
    }
}

$hewanPeliharaan = new Anjing("gemini");
echo $hewanPeliharaan->suara();
?>