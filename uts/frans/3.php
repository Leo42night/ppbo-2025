<?php
class Kendaraan {
    public function mogok(){
        echo "tapi tak bisa";
    }

    public function jalan(){
        echo "kendaraan sedang berjalan" . mogok();

    class Mobil extends Kendaraan {
        echo jalan (). mogok();
    }

    }
}

