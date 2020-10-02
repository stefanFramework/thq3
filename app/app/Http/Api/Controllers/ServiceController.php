<?php


namespace App\Http\Api\Controllers;

use App\Domain\Models\Service;
use App\Domain\Repositories\Interfaces\IServiceRepository;
use App\Http\Controllers\Controller;
use Illuminate\Support\Collection;

class ServiceController extends Controller
{
    private IServiceRepository $serviceRepository;

    public function __construct(IServiceRepository $serviceRepository)
    {
        $this->serviceRepository = $serviceRepository;
    }
    public function index()
    {
        $services = $this->serviceRepository->findAll();
        $data = $this->getData($services);
        return response()->json($data, 200);
    }

    private function getData(Collection $services)
    {
        return $services->map(function (Service $service) {
            return [
                'id' => $service->id,
                'name' => $service->name,
                'team' => strtolower($service->team),
                'version' => ''
            ];
        })->toArray();
    }
}
