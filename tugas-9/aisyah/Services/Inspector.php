<?php
namespace PerpustakaanApp\Services;

use ReflectionClass;

class Inspector {
    public static function inspectClass(string $className): array {
        $reflection = new ReflectionClass($className);
        
        return [
            'name' => $reflection->getName(),
            'namespace' => $reflection->getNamespaceName(),
            'methods' => array_map(
                fn($m) => $m->getName(),
                $reflection->getMethods()
            ),
            'properties' => array_map(
                fn($p) => $p->getName(),
                $reflection->getProperties()
            ),
            'constants' => $reflection->getConstants(),
            'is_abstract' => $reflection->isAbstract(),
            'is_final' => $reflection->isFinal(),
        ];
    }
}
