<?php
declare(strict_types=1);

namespace App\Repository;


use App\Factory\Factory;
use App\Factory\FactoryInterface;
use ReflectionException;
use RuntimeException;

class VehicleRepository extends AbstractRepository
{
    protected ?string $className;
    private FactoryInterface $factory;

    /**
     * VehicleRepository constructor.
     * @param $adapter
     * @param string|null $className
     */
    public function __construct($adapter, ?string $className = null)
    {
        parent::__construct($adapter);
        $this->className = $className;
        $this->factory = new Factory();
    }

    /**
     * @param object $data
     * @param string|null $className
     * @return object
     */
    private function populate(object $data, ?string $className = null): object
    {
        if($className !== null) {
            try {
                return $this->factory->make($data, $className);
            } catch (ReflectionException $e) {
                throw new RuntimeException($e->getMessage(), (int)$e->getCode(), $e);
            }
        }
        return $data;
    }

    /**
     * @param int $id
     * @return object|null
     */
    public function find(int $id): ?object
    {
        $result = parent::find($id);
        if ($result === null) {
            return null;
        }

        return  $this->populate($result, $this->className);
    }

    /**
     * @param int|null $number
     * @param int $offset
     * @return iterable
     */
    public function get(int $number = null, int $offset = 0): iterable
    {
        return array_map(fn (object $item)=> $this->populate($item, $this->className), (array) parent::get($number, $offset));
    }

}