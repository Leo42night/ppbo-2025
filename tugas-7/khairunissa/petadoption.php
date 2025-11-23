<?php
// --- AUTOLOADER DAN USE STATEMENT ---
spl_autoload_register(function ($class) {
    
    $base_dir = __DIR__ . '/src/';

    $relative_class = str_replace('AdopsiHewan\\', '', $class);

    $file_path = str_replace('\\', '/', $relative_class);

    $file = $base_dir . $file_path . '.php';
    
    if (file_exists($file)) {
        require_once $file;
    }
});

use AdopsiHewan\Models\Anjing;
use AdopsiHewan\Controllers\ManajemenAdopsi;
use AdopsiHewan\Utilities\Reflektor;
use AdopsiHewan\Interfaces\CrudInterface;

// 1. TANGKAP SEMUA OUTPUT DENGAN BUFFERING (ob_start() harus dipanggil di awal!)
ob_start();

// 2. INISIALISASI (Output Log/Refleksi akan tertangkap di sini)
$reflector = new Reflektor();
$manajemen = new ManajemenAdopsi($reflector); 

// Variabel untuk menampung output utama (non-log/refleksi)
$main_output = '';

try {
    $anjing1 = new Anjing("Bolt", 36, "Golden Retriever", "Tinggi");
    $anjing2 = new Anjing("Lassie", 12, "Border Collie", "Sedang");

    // --- 1. DETAIL HEWAN & MAGIC METHODS ---
    $main_output .= '<h2>1. Detail Hewan, Encapsulation & Magic Methods</h2>';
    $main_output .= '<div class="result-block">';
    $main_output .= "<strong>Nama (public):</strong> " . $anjing1->nama . "<br>";
    $main_output .= "<strong>Umur (private via getter):</strong> " . $anjing1->getUmurTahun() . " tahun<br>";
    $main_output .= "<strong>Polymorphism (Suara):</strong> " . $anjing1->bersuara() . "<br>";
    $main_output .= "<strong>Magic Method __call():</strong> " . $anjing1->tampilkanStatus() . "<br>"; 
    $main_output .= "<strong>Magic Method __toString():</strong> <pre>" . $anjing1 . "</pre>"; 
    $main_output .= '</div>';

    // --- 2. CONSTANTS, FINAL, STATIC ---
    $main_output .= '<h2>2. Constants, Final Keyword & Static Binding</h2>';
    $main_output .= '<div class="result-block">';
    $main_output .= "<strong>Class Constants:</strong> Status Default: " . Anjing::STATUS_ADOP . "<br>";
    $main_output .= "<strong>Final Function:</strong> Tingkat Energi: " . $anjing1->tampilkanEnergi() . "<br>";
    $main_output .= "<strong>Static Binding:</strong> Kategori: " . Anjing::getKategori() . "<br>";
    $main_output .= '</div>';

    // --- 3. CRUD & INTERFACES ---
    $main_output .= '<h2>3. Penerapan CRUD (Interface)</h2>';
    $main_output .= '<div class="result-block">';
    $manajemen->buat(['nama' => $anjing2->nama, 'ras' => $anjing2->getRas(), 'energi' => $anjing2->tampilkanEnergi()]);
    $dataAdopsi = $manajemen->baca(1);
    $main_output .= "<strong>Data Adopsi ID 1 Dibaca:</strong> " . ($dataAdopsi ? $dataAdopsi['nama'] : 'Tidak ada') . "<br>";
    $manajemen->perbarui(1, ['status_adopsi' => 'Diadopsi']);
    $main_output .= "<strong>Status Baru ID 1:</strong> " . $manajemen->baca(1)['status_adopsi'] . "<br>";
    $manajemen->hapus(1);
    $main_output .= "Data Adopsi ID 1 Dihapus.<br>";
    $main_output .= '</div>';

    // --- 4. CLONING, ITERATION, SERIALIZATION & ANONYMOUS ---
    $main_output .= '<h2>4. Cloning, Iteration, Serialization & Anonymous Class</h2>';
    $main_output .= '<div class="result-block">';
    $anjing3 = clone $anjing1;
    $anjing3->nama = "Duplikat Bolt";
    $main_output .= "<strong>Cloning Object:</strong> Anjing 3 Nama: " . $anjing3->nama . "<br>";

    $iteration_output = '';
    foreach ($anjing2 as $key => $value) {
        if (is_string($value)) {
            $iteration_output .= "{$key}: {$value}\n";
        }
    }
    $main_output .= "<strong>Object Iteration (Properti Publik):</strong><pre>" . $iteration_output . "</pre>";

    $serializedAnjing = serialize($anjing2);
    $main_output .= "Objek Anjing 2 diserialisasi.<br>";
    $unserializedAnjing = unserialize($serializedAnjing);
    $main_output .= "Objek Anjing 2 diunserialisasi: <strong>" . $unserializedAnjing->nama . "</strong><br>";

    $emailSender = new class implements CrudInterface {
        public function buat(array $data): void { echo "<strong>Anonymous Class:</strong> AC: Mengirim email konfirmasi...<br>"; }
        public function baca(int $id): ?array { return null; }
        public function perbarui(int $id, array $data): bool { return false; }
        public function hapus(int $id): bool { return false; }
    };
    $emailSender->buat(['penerima' => 'adopter@example.com']);
    $main_output .= '</div>';
    
} catch (\InvalidArgumentException $e) {
    // --- 5. EXCEPTION HANDLING ---
    $main_output .= '<h2>5. Exception Handling (ERROR)</h2>';
    $main_output .= '<div class="result-block error-block">';
    $main_output .= "ERROR: <pre>" . htmlspecialchars($e->getMessage()) . "</pre>";
    $main_output .= '</div>';
}

// 3. TANGKAP DAN TAMPILKAN LOG & REFLEKSI DI BAGIAN AKHIR
$log_output = ob_get_clean(); // Mengakhiri buffering dan mendapatkan output
$log_entries = explode("\n", $log_output);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Sistem Adopsi Hewan OOP PHP</title>
    <link rel="stylesheet" href="petstyle.css"> 
</head>
<body>
<div class="container">
    <h1>Adopt a Bit</h1>
    <p>Cute pets are waiting for you!</p>

    <?php echo $main_output; ?>

    <h2>6. Log (Trait) & Reflection Output</h2>
    <div class="result-block log-block">
        <?php
        foreach ($log_entries as $entry) {
            if (trim($entry) !== '') {
                // Ini akan membungkus setiap baris Log/Refleksi ke dalam div terpisah
                echo "<div class='log-entry'>" . htmlspecialchars($entry) . "</div>";
            }
        }
        ?>
    </div>

</div>
</body>
</html>