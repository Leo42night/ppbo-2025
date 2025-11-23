<?php
namespace Models;

final class Pelanggan {
    private string $nama;
    public function __construct(string $nama) { $this->nama = $nama; }
    public function getNama(): string { return $this->nama; }
}
