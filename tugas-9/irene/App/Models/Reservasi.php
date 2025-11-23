<?php
namespace App\Models;

use App\Core\Database;
use Exception;

abstract class ReservasiAbstract {
    abstract public function buatReservasi(string $namaTamu, Kamar $kamar): void;
}

final class Reservasi extends ReservasiAbstract {
    private Database $db;
    private array $data = [];

    public function __construct(Database $db) {
        $this->db = $db;
    }

    public function buatReservasi(string $namaTamu, Kamar $kamar): void {
        try {
            $kamar->pesan();
            $record = [
                'nama_tamu' => $namaTamu,
                'tipe_kamar' => $kamar->tipe,
                'harga' => $kamar->getHarga()
            ];
            $this->db->insert('reservasi', $record);
            $this->data = $record;
        } catch (Exception $e) {
            echo "Gagal reservasi: " . $e->getMessage() . "\n";
        }
    }

    // Serialization
    public function __sleep(): array {
        return ['data'];
    }

    public function __wakeup(): void {
        echo "Reservasi berhasil di-load kembali!\n";
    }

    public function __clone() {
        $this->data['nama_tamu'] .= " (Copy)";
    }
}

