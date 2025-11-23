<?php
namespace PerpustakaanApp\Views;

class LibraryView {
    
    public function renderHeader(): void {
        echo '<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Manajemen Perpustakaan Digital</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 20px;
            line-height: 1.6;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            background: white;
            border-radius: 15px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
        }
        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 40px;
            text-align: center;
            border-radius: 15px 15px 0 0;
        }
        .header h1 { font-size: 2.5em; margin-bottom: 10px; }
        .content { padding: 40px; }
        .section {
            margin-bottom: 40px;
            background: #f8f9fa;
            border-radius: 10px;
            padding: 25px;
            border-left: 5px solid #667eea;
        }
        .section-title { color: #667eea; font-size: 1.5em; margin-bottom: 15px; }
        .info-box {
            background: white;
            padding: 15px;
            border-radius: 8px;
            margin: 10px 0;
            border: 1px solid #e0e0e0;
        }
        .info-label { color: #666; font-weight: 600; margin-bottom: 5px; }
        .info-value {
            color: #333;
            font-family: "Courier New", monospace;
            background: #f5f5f5;
            padding: 8px 12px;
            border-radius: 5px;
            display: inline-block;
        }
        .log-item {
            background: #fff3cd;
            border-left: 3px solid #ffc107;
            padding: 10px 15px;
            margin: 5px 0;
            border-radius: 5px;
            font-family: "Courier New", monospace;
            font-size: 0.9em;
        }
        .item-list {
            background: white;
            border-radius: 8px;
            padding: 15px;
            margin: 10px 0;
        }
        .item {
            padding: 12px;
            margin: 8px 0;
            background: #f8f9fa;
            border-radius: 6px;
            border-left: 4px solid #28a745;
        }
        .item.borrowed { border-left-color: #dc3545; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>SISTEM MANAJEMEN PERPUSTAKAAN DIGITAL</h1>
            <p>MVC Architecture + Namespace Implementation</p>
        </div>
        <div class="content">';
    }
    
    public function renderFooter(): void {
        echo '        </div>
    </div>
</body>
</html>';
    }
    
    public function renderSection(string $title, string $content): void {
        echo "<div class='section'>
            <h2 class='section-title'>{$title}</h2>
            {$content}
        </div>";
    }
}