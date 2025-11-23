<?php
// 14. MVC Sederhana (Controller), 18. Dependency Injection
namespace PerpustakaanOOP\Controller;

use PerpustakaanOOP\Model\Buku;
use PerpustakaanOOP\View\BukuView;
use PerpustakaanOOP\Utils\Database;

class BukuController {
    // 18. Dependency Injection (melalui Constructor)
    private BukuView $bukuView;

    public function __construct(BukuView $bukuView) { // 18. Type Hinting parameter
        $this->bukuView = $bukuView;
    }

    // 14. CRUD (Simulasi) - Tambah Data
    public function tambahBuku(Buku $buku): void {
        Database::simpanBuku($buku); // 12. Static method
        echo "Buku '{$buku->getJudul()}' berhasil ditambahkan ke database (Simulasi).<br>";
    }
    
    // 14. CRUD (Simulasi) - Hapus Data
    public function hapusBuku(string $isbn): void {
        if (Database::hapusBuku($isbn)) {
            echo "Buku dengan ISBN '{$isbn}' berhasil dihapus (Simulasi).<br>";
        } else {
            echo "Buku dengan ISBN '{$isbn}' tidak ditemukan.<br>";
        }
    }

    // 14. MVC - Menampilkan daftar buku
    public function index(): string {
        $dataBuku = Database::getKoleksiBuku(); // 12. Static method
        return $this->bukuView->renderAll($dataBuku);
    }
}