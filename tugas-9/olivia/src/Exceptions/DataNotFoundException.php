<?php

namespace App\Exceptions;

// 10. Exception Handling (Custom Exception)
class DataNotFoundException extends \Exception
{
    public function __construct($message = "Data tidak ditemukan.", $code = 404, ?\Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    public function getDetailedMessage(): string
    {
        return "Error: Terjadi kesalahan saat mengambil data dari database. " . $this->getMessage();
    }
}