<?php
namespace App\Models;

class ReflectionHelper {
    public static function lihatProperti($objek) {
        $ref = new \ReflectionClass($objek);
        echo "<ul>";
        foreach ($ref->getProperties() as $prop) {
            echo "<li>{$prop->getName()}</li>";
        }
        echo "</ul>";
    }
}
