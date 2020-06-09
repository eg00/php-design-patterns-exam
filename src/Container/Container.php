<?php
declare(strict_types=1);

namespace App\Container;

use Psr\Container\ContainerInterface;

class Container implements ContainerInterface{

    protected array $instances = [];
    /**
     * @param      $abstract
     * @param null $concrete
     */
    public function set($abstract, $concrete = null)
    {
        if ($concrete === null) {
            $concrete = $abstract;
        }
        $this->instances[$abstract] = $concrete;
        return $this;
    }

    public function get($id)
    {
        if (!$this->has($id)) {
            $this->set($id);
        }
        return $this->instances[$id];
    }

    public function has($id)
    {
       return array_key_exists($id, $this->instances);
    }
}