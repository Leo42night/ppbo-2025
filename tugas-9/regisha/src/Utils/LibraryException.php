<?php
// 9. Exception Handling (custom Exception), 13. Namespaces
namespace PerpustakaanOOP\Utils;

class LibraryException extends \Exception {
    public function __construct(string $message, int $code = 0, ?\Throwable $previous = null) {
        parent::__construct($message, $code, $previous);
    }

    public function getCustomErrorMessage(): string {
        return "ERROR: " . $this->getMessage() . " di baris " . $this->getLine() . " pada file " . $this->getFile();
    }
}