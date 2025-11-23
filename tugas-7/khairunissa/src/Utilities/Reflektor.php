<?php
namespace AdopsiHewan\Utilities;

// 17. Reflection
class Reflektor {
    public function analisisClass(string $className): void {
        try {
            $reflector = new \ReflectionClass($className);
            echo "--- Refleksi: Analisis class {$className} ---\n";
            echo "Jumlah method: " . count($reflector->getMethods()) . "\n";
            echo "----------------------------------------\n";
        } catch (\ReflectionException $e) {
            echo "Error Refleksi: " . $e->getMessage() . "\n";
        }
    }
}