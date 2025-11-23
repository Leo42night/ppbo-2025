<?php
namespace App\Controllers;

use App\Core\Database;
use App\Models\Hotel;
use App\Models\Kamar;
use App\Models\Reservasi;
use App\Models\Pembayaran;
use ReflectionClass;

class ReservasiController {
    private Database $db;

    public function __construct(Database $db) {
        $this->db = $db;
    }

    public function buatReservasi(string $namaTamu, string $tipeKamar, string $tanggal): array {
        $hotel = new Hotel("Hotel Mawar", "Bandung");
        $kamar = new Kamar($tipeKamar, 500000);
        $hotel->tambahKamar($kamar);

        $reservasi = new Reservasi($this->db);
        $reservasi->buatReservasi($namaTamu, $kamar);

        // Anonymous class untuk notifikasi
        $notifikasi = new class {
            public function kirim(string $pesan): void {
                echo "Notifikasi: $pesan";
                echo "<br>";
            }
        };
        $notifikasi->kirim("Reservasi untuk $namaTamu berhasil dibuat!");

        // Reflection example
        $ref = new ReflectionClass($reservasi);
        echo "Class Reservasi memiliki " . count($ref->getMethods()) . " method";
        echo "<br>";

        // Object Iteration (Hotel)
        foreach ($hotel as $k) {
            echo "Kamar: {$k->tipe}";
            echo "<br>";
            echo "Harga: {$k->getHarga()}";
            echo "<br>";
        }

        // Cloning object demo
        $clone = clone $reservasi;
        echo "Clone data reservasi disiapkan untuk backup.";
        echo "<br>";

        // Serialization demo
        $serialized = serialize($reservasi);
        $unserialized = unserialize($serialized);

        // Pembayaran demo
        $pembayaran = new Pembayaran(500000, "Transfer Bank");
        echo $pembayaran->proses();
        echo "<br>";
        echo Pembayaran::konfirmasi();
        echo "<br>";

        return [
            'namaTamu'  => $namaTamu,
            'tipeKamar' => $tipeKamar,
            'tanggal'   => $tanggal,
            'harga'     => $kamar->getHarga(),
            'status'    => 'Reservasi berhasil dibuat',
        ];
    }
}
