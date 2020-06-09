<?php
declare(strict_types=1);

namespace App\Factory;

use ReflectionClass;
use ReflectionException;

class Factory implements FactoryInterface
{

    /**
     * @param $data
     * @param string|null $className
     * @return object
     * @throws ReflectionException
     */
    public function make($data, ?string $className = null): object
    {
        return $this->createClass((array)$data, $className);
    }

    /**
     * @param array $data
     * @param string $className
     * @return object
     * @throws ReflectionException
     */
    private function createClass(array $data, string $className): object
    {
        $reflection = new ReflectionClass($className);
        $properties = $reflection->getProperties();
        $class = $reflection->newInstance();
        foreach ($properties as $property) {
            if (array_key_exists($property->name, $data)) {
                $property->setAccessible(true);
                $property->setValue($class, $data[$property->name]);
            }
        }

        return $class;

    }
}