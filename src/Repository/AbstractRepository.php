<?php
declare(strict_types=1);

namespace App\Repository;

use App\Adapter\AdapterInterface;
use OutOfRangeException;

abstract class AbstractRepository
{
    protected AdapterInterface $adapter;
    protected iterable $data;

    public function __construct(AdapterInterface $adapter)
    {
        $this->adapter = $adapter;
        $this->data = $this->adapter->getData();
    }

    public function find(int $id): ?object
    {
        $index = array_search($id, array_column((array)$this->data, 'id'));

        return $index ? $this->data[$index] : null;
    }

    public function get(int $number = null, int $offset = 0): iterable
    {
        if($offset>= count($this->data)) {
            throw new OutOfRangeException('illegal offset');
        }

        return  array_slice((array)$this->data, $offset,$number);
    }
}