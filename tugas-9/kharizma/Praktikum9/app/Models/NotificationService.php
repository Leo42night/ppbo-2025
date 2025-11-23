<?php
namespace App\Models;

class NotificationService {
    public static function kirim($pesan) {
        echo "<div style='padding:10px;background:#e7f3ff;border:1px solid #b3d4fc;margin:10px 0;'>📢 $pesan</div>";
    }
}
