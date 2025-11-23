<?php
declare(strict_types=1);
namespace LaundryApp\Traits;

trait LoggerTrait
{
    protected function log(string $msg): void
    {
        // simple logging to file with timestamp
        $file = __DIR__ . '/../../logs/app.log';
        @mkdir(dirname($file), 0777, true);
        file_put_contents($file, date('c') . ' ' . $msg . PHP_EOL, FILE_APPEND);
    }
}
