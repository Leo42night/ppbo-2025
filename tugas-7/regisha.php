<?php
// Perpustakaan Sederhana

// 1. Scope + 2. Encapsulation + 3. Magic Methods
class Buku {
    public $judul;            
    private $penulis;         
    protected $tahunTerbit;

    public function __construct(string $judul, string $penulis, int $tahun) {
        $this->judul = $judul;
        $this->penulis = $penulis;
        $this->tahunTerbit = $tahun;
        echo "Buku '{$this->judul}' berhasil dibuat.<br>";
    }

    public function __destruct() {
        echo "Buku '{$this->judul}' dihapus dari sistem.<br>";
    }

    public function getPenulis(): string {
        return $this->penulis;
    }
    public function setPenulis(string $penulis): void {
        $this->penulis = $penulis;
    }

    public function __get($name) {
        return "Properti '{$name}' tidak tersedia.";
    }
    public function __set($name, $value) {
        echo "Menetapkan properti '{$name}' = '{$value}'.<br>";
    }

    public function __toString(): string {
        return "Judul: {$this->judul}, Penulis: {$this->penulis}";
    }

    public function __call($name, $arguments) {
        echo "Dipanggil method tidak ada: '{$name}' dengan argumen: " . implode(', ', $arguments) . "<br>";
    }
}

// 4. Inheritance + Polymorphism (override)
class BukuDigital extends Buku {
    public $format;
    public function __construct(string $judul, string $penulis, int $tahun, string $format) {
        parent::__construct($judul, $penulis, $tahun);
        $this->format = $format;
    }
    public function getPenulis(): string {
        return "Penulis e-book ini: " . parent::getPenulis();
    }
}

// 5. Class Constants + 12. Static Properties & Methods
class Perpustakaan {
    const NAMA = "Perpus selena";
    public static $jumlahBuku = 0;
    public static function tambahBuku(): void { self::$jumlahBuku++; }
}

// 6. Late Static Binding
class Anggota {
    public static function jenis() { 
        return self::class; 
    }
    public static function siapa() {
        return static::class; 
    }
}
class Mahasiswa extends Anggota {}

// 7. Final Keyword
final class Admin {
    final public function hakAkses(): string {
        return "Admin punya semua akses.";
    }
}

// 8. Type Hinting
function hitungDenda(int $hariTelat): string {
    return "Denda Anda: Rp" . ($hariTelat * 1000);
}

// 9. Exception Handling
function pinjamBuku(int $stok): void {
    try {
        if ($stok <= 0) throw new Exception("Buku habis dipinjam!");
        echo "Buku berhasil dipinjam.<br>";
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage() . "<br>";
    } finally {
        echo "Sistem selesai memproses peminjaman.<br>";
    }
}

// 10. Trait
trait CetakInfo { public function info(): void {
    echo "Cetak informasi (Trait): objek memiliki data yang siap ditampilkan.<br>";
} }
class Koleksi { use CetakInfo; }

// 11. Polymorphism
interface Pengguna { 
    public function aksesPerpus(): string; 
}
abstract class User { 
    abstract public function role(): string; 
}
class MahasiswaUser extends User implements Pengguna {
    public function aksesPerpus(): string { 
        return "Mahasiswa dapat meminjam buku."; 
    }
    public function role(): string { 
        return "Mahasiswa"; 
    }
}

// 15. Serialization
class DataPerpus { 
    public $koleksi = "Buku A"; public function __sleep(){ 
        return ['koleksi']; 
    }
    public function __wakeup(){ 
        echo "Objek DataPerpus dibangunkan kembali.<br>"; 
    } 
}

// 16. Iteration
class KoleksiIterator implements IteratorAggregate {
    private $koleksi = ["Algoritma", "Rantai Pasok", "Struktur Data"];
    public function getIterator(): Traversable {
        return new ArrayIterator($this->koleksi); 
    }
}

// 17. Reflection
class Refleksi { 
    public $nama = "Demo Refleksi"; 
}

// 18. Dependency Injection
class Notifikasi { 
    public function kirim(string $pesan): void { 
        echo "Notif: $pesan<br>"; 
    } 
}

class Sistem {
    private $notifikasi;
    public function __construct(Notifikasi $notif) { 
        $this->notifikasi = $notif; 
    }
    public function jalan(): void { 
        $this->notifikasi->kirim("Sistem perpustakaan berjalan."); 
    }
}

// 19. Clone
class CloneContoh {
    public $data = "Asli";
    public function __clone() { 
        $this->data = "Hasil Clone"; 
    }
}

// 20. Anonymous Class
$anon = new class { 
    public function halo(): string { 
        return "Halo dari Anonymous Class!"; 
    } 
};


// ================= OUTPUT =================
echo "=== SISTEM PERPUSTAKAAN SELENA ===<br><br>";

$b1 = new Buku("Algoritma", "Pak Budi", 2022);
echo $b1 . "<br><br>";

$b1->edisi = "Cetakan pertama";
echo $b1->nonexistentProperty . "<br><br>";

$ebook = new BukuDigital("PBO", "Re", 2020, "PDF");
echo $ebook->getPenulis() . "<br><br>";

echo "Nama Perpus: " . Perpustakaan::NAMA . "<br>";
Perpustakaan::tambahBuku();
Perpustakaan::tambahBuku();
echo "Jumlah Buku: " . Perpustakaan::$jumlahBuku . "<br><br>";

echo "Identitas Anggota:<br>";
echo "- Self:: " . Anggota::jenis() . "<br>";
echo "- Static:: " . Mahasiswa::siapa() . "<br><br>";

echo "Perhitungan Denda:<br>";
echo hitungDenda(3) . "<br><br>";

echo "Proses Peminjaman:<br>";
pinjamBuku(0);
echo "<br>";

echo "Cetak Informasi Koleksi:<br>";
$k = new Koleksi(); $k->info(); echo "<br>";

echo "Hak Akses Mahasiswa:<br>";
$mhsUser = new MahasiswaUser();
echo $mhsUser->aksesPerpus() . " (Role: " . $mhsUser->role() . ")<br><br>";

echo "Daftar Koleksi Perpustakaan:<br>";
$koleksi = new KoleksiIterator();
foreach ($koleksi as $judul) echo "- $judul<br>";
echo "<br>";

echo "Hasil Refleksi Class:<br>";
$ref = new ReflectionClass('Refleksi');
echo "Refleksi class: " . $ref->getName() . "<br><br>";

echo "Notifikasi Sistem:<br>";
$notif = new Notifikasi(); 
$sistem = new Sistem($notif);
$sistem->jalan(); echo "<br>";

echo "Percobaan Cloning:<br>";
$ori = new CloneContoh(); 
$salin = clone $ori;
echo "Asli: {$ori->data}, Clone: {$salin->data}<br><br>";

echo "Anonymous Class:<br>";
echo $anon->halo() . "<br><br>";

echo "=== AKHIR SISTEM ===<br>";
?>
