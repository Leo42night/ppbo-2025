<?php
// 14. Penerapan membuat CRUD
namespace AdopsiHewan\Controllers;

use AdopsiHewan\Interfaces\CrudInterface;
use AdopsiHewan\Models\Anjing;

// 7. Final Keyword: final class
final class ManajemenAdopsi implements CrudInterface {
    private array $dataStorage = [];
    
    // 18. Dependency Injection (DI)
    public function __construct(\AdopsiHewan\Utilities\Reflektor $reflektor) {
        // Contoh DI: Menerima objek Reflektor melalui constructor
        $reflektor->analisisClass(static::class);
    }

    // 8. Type Hinting: array data
    public function buat(array $data): void {
        $id = count($this->dataStorage) + 1;
        $this->dataStorage[$id] = $data;
        echo "Hewan '{$data['nama']}' dengan ID {$id} berhasil didaftarkan.\n";
    }

    // 8. Type Hinting: return type ?array (Union Type)
    public function baca(int $id): ?array {
        return $this->dataStorage[$id] ?? null;
    }

    public function perbarui(int $id, array $data): bool {
        if (isset($this->dataStorage[$id])) {
            $this->dataStorage[$id] = array_merge($this->dataStorage[$id], $data);
            return true;
        }
        return false;
    }

    public function hapus(int $id): bool {
        if (isset($this->dataStorage[$id])) {
            unset($this->dataStorage[$id]);
            return true;
        }
        return false;
    }
}