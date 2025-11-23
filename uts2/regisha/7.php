<?php

class Kamar {
    public $nomorKamar;
    public $tipeKamar;
    private $harga;

    public function setHarga($harga) {
        $this->harga = $harga;
    }

    public function getHarga() {
        return $this->harga;
    }
}

class Deluxe extends Kamar {
    public function getHarga() {
        return parent::getHarga() * 1.2;
    }
}

class Suite extends Kamar {
    public function getHarga() {
        return parent::getHarga() * 1.5;
    }
}

class Tamu {
    public $nama;
    public $idTamu;
}

class Reservasi {
    private $tamu;
    private $kamar;
    private static $jumlahReservasi = 0;

    public function setData($tamu, $kamar) {
        $this->tamu = $tamu;
        $this->kamar = $kamar;
        self::$jumlahReservasi++;
    }

    public function hitungTotalBiaya($malam) {
        return $this->kamar->getHarga() * $malam;
    }

    public function tampilInfo($malam) {
        echo "Tamu: {$this->tamu->nama} (ID: {$this->tamu->idTamu})\n";
        echo "Kamar: {$this->kamar->nomorKamar} - {$this->kamar->tipeKamar}\n";
        echo "Jumlah Malam: {$malam}\n";
        echo "Total Biaya: Rp " . number_format($this->hitungTotalBiaya($malam), 0, ',', '.') . "\n\n";
    }
}

$tamu1 = new Tamu();
$tamu1->nama = "Budi";
$tamu1->idTamu = "T001";

$kamar1 = new Deluxe();
$kamar1->nomorKamar = 101;
$kamar1->tipeKamar = "Deluxe";
$kamar1->setHarga(500000);

$res1 = new Reservasi();
$res1->setData($tamu1, $kamar1);
$res1->tampilInfo(3);

// ----

$tamu2 = new Tamu();
$tamu2->nama = "Sari";
$tamu2->idTamu = "T002";

$kamar2 = new Suite();
$kamar2->nomorKamar = 202;
$kamar2->tipeKamar = "Suite";
$kamar2->setHarga(800000);

$res2 = new Reservasi();
$res2->setData($tamu2, $kamar2);
$res2->tampilInfo(2);
