<?php
declare(strict_types=1);

namespace App\Controller;

use App\Adapter\CsvAdapter;
use App\Adapter\JsonAdapter;
use App\Entity\Vehicle;
use App\Repository\VehicleRepository;
use Psr\Container\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class MainController extends AbstractController
{

    private CsvAdapter $csvAdapter;
    private JsonAdapter $jsonAdapter;

    /**
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        parent::__construct($container);
        $this->csvAdapter = $this->container->get(CsvAdapter::class);
        $this->jsonAdapter = $this->container->get(JsonAdapter::class);
    }

    public function index(): Response
    {
        $csvData = (new VehicleRepository($this->csvAdapter, Vehicle::class))->get();
        $jsonData = (new VehicleRepository($this->jsonAdapter, Vehicle::class))->get();

       return $this->render('index.twig', compact(['csvData', 'jsonData']));
    }

    public function show(Request $request): Response
    {
        if ((!$id = $request->get('id')) || (!$source = $request->get('source'))) {
            return new Response(sprintf('"%s" and "%s" must be defined', 'id', 'source'), Response::HTTP_BAD_REQUEST);
        }

        switch ($source) {
            case 'csv':
                $adapter = $this->csvAdapter;
                break;
            case 'json' :
                $adapter = $this->jsonAdapter;
                break;
            default:
                return new Response(sprintf('"%s" adapter is not defined', $source));
        }

        $item = (new VehicleRepository($adapter))->find((int) $id);

        if(!$item) {
            return new Response(sprintf('Entity from source "%s" with ID "%d" not found', $source, $id));
        }
        return $this->render('item.twig', compact('item'));
    }
}