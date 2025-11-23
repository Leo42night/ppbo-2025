<?php
namespace App\Utils;

// PSR-4 expects file name to reflect class name; this small file provides the Reflector class
// to match the usage in index.php. The actual implementation can remain in Reflection.php or here.

use ReflectionClass;

class Reflector {
    public static function refleksi($obj) {
        $class = new ReflectionClass($obj);
        echo "Refleksi kelas: " . $class->getName() . "\n";
        foreach ($class->getProperties() as $prop) {
            echo " - " . $prop->getName() . "\n";
        }
    }
}
