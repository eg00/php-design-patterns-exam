<?php
declare(strict_types=1);

namespace App\Factory;

interface FactoryInterface
{
    /**
     * @param $data
     * @param string|null $className
     * @return object
     */
    public function make($data, ?string $className = null): object;
}