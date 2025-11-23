<?php
// 14. MVC Sederhana (View)
namespace PerpustakaanOOP\View;

class BukuView {
    public function renderAll(array $bukuList): string {
        $output = "<h2>Daftar Buku (View)</h2>";
        if (empty($bukuList)) {
            $output .= "<p>Belum ada buku dalam koleksi.</p>";
            return $output;
        }
        $output .= "<ul>";
        foreach ($bukuList as $buku) {
            $output .= "<li>" . $buku . "</li>"; // menggunakan __toString()
        }
        $output .= "</ul>";
        return $output;
    }
}