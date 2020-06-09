<?php
declare(strict_types=1);

namespace App;

use RuntimeException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class Application
{
    private static $instance = null;
    private $routes = null;

    public static function getInstance($routes = null): Application
    {

        if (static::$instance) {
            return self::$instance;
        }
        static::$instance = new static();
        if ($routes) {
            static::$instance->routes = $routes;
        }
        return self::$instance;
    }

    public function handle(Request $request, $routes = null): Response
    {
        if ($routes) {
            $this->routes = $routes;
        }
        if ($this->routes === null) {
            throw new RuntimeException('Routes config is not defined');
        }

        if (!array_key_exists($request->getPathInfo(), $this->routes)) {
            return new Response('Page not found', Response::HTTP_NOT_FOUND);
        }

        $callback = $this->routes[$request->getPathInfo()];

        return $callback($request);
    }
}