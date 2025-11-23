<?php

namespace App\Core;

final class View // Final class contoh kecil (7), opsional
{
    public function __construct(private string $publicDir) {}

    public function render(string $title, string $content): string
    {
        return <<<HTML
            <!doctype html>
            <html lang="id"><meta charset="utf-8">
            <title>{$title}</title>
            <link rel="preconnect" href="https://fonts.gstatic.com" />
            <style>
            body{font-family:system-ui,Arial;padding:24px;max-width:800px;margin:auto}
            header{display:flex;justify-content:space-between;align-items:center;margin-bottom:16px}
            table{border-collapse:collapse;width:100%}td,th{border:1px solid #ddd;padding:8px}
            form{margin:12px 0}
            code{background:#f6f8fa;padding:2px 4px;border-radius:4px}
            </style>
            <header><h1>Mini CRUD Buku</h1><a href="/pbo/shalwa/books">Semua Buku</a></header>
            {$content}
            </html>
            HTML;
    }
}
