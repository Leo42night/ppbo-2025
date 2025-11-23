<?php
namespace PerpustakaanApp\Models\Traits;

trait Loggable {
    private array $logs = [];
    
    public function log(string $message): void {
        $this->logs[] = date('[Y-m-d H:i:s] ') . $message;
    }
    
    public function getLogs(): array {
        return $this->logs;
    }
}