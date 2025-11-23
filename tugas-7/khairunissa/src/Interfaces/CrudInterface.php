<?php
// 11. Polymorphism (Overriding method) menggunakan interface
namespace AdopsiHewan\Interfaces;

interface CrudInterface {
    public function buat(array $data): void;
    public function baca(int $id): ?array;
    public function perbarui(int $id, array $data): bool;
    public function hapus(int $id): bool;
}