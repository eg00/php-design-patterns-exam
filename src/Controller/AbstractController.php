<?php
declare(strict_types=1);

namespace App\Controller;

use Psr\Container\ContainerInterface;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

class AbstractController {
    protected ContainerInterface $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    protected function render(string $template, array $params): Response
    {
        $twig = $this->container->get(Environment::class);

        return new Response($twig->render($template, $params), Response::HTTP_OK);
    }
}

