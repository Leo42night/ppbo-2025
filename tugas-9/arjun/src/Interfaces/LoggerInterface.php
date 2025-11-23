<?php
namespace Interfaces;

interface LoggerInterface {
    public function log(string $message): void;
}