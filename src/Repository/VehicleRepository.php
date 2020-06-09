<?php
declare(strict_types=1);

namespace App\Repository;

class VehicleRepository extends AbstractRepository
{
    /**
     * VehicleRepository constructor.
     * @param $adapter
     */
    public function __construct($adapter)
    {
        parent::__construct($adapter);
    }

}