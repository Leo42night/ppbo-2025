<?php

namespace App\Services;

// 18. Reflection
class ReflectionService
{
    public static function analyzeClass(object $object): array
    {
        $reflection = new \ReflectionClass($object);
        $className = $reflection->getName();
        $properties = [];
        foreach ($reflection->getProperties() as $prop) {
            $properties[] = $prop->getName() . ' (' . ($prop->isPublic() ? 'public' : ($prop->isProtected() ? 'protected' : 'private')) . ')';
        }
        $methods = [];
        foreach ($reflection->getMethods(\ReflectionMethod::IS_PUBLIC) as $method) {
            $methods[] = $method->getName();
        }

        return [
            'className' => $className,
            'parentClass' => $reflection->getParentClass() ? $reflection->getParentClass()->getName() : 'None',
            'properties' => $properties,
            'public_methods' => $methods
        ];
    }
}