<?php
declare(strict_types=1);

use App\Adapter\CsvAdapter;
use App\Adapter\JsonAdapter;
use App\Application;
use App\Container\Container;
use App\Controller\MainController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

require_once __DIR__ . '/../../vendor/autoload.php';
$loader = new FilesystemLoader(dirname(__DIR__) . '/templates');
$twig = new Environment($loader);

$container = (new Container())
    ->set(Environment::class, $twig)
    ->set(CsvAdapter::class, new CsvAdapter(dirname(__DIR__) . '/dataSource/data.csv'))
    ->set(JsonAdapter::class, new JsonAdapter(dirname(__DIR__) . '/dataSource/data.json'));

$routes = [
    '/test' => static fn(Request $request): Response => new Response('Hello, world'),
    '/' => static fn() : Response => (new MainController($container))->index(),
    '/item' => static fn(Request $request): Response => (new MainController($container))->show($request),
];

$app = Application::getInstance($routes);

$response = $app->handle(Request::createFromGlobals());
$response->send();