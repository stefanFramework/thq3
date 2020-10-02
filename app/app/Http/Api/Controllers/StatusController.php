<?php


namespace App\Http\Api\Controllers;


use App\Domain\Models\StatusReport;
use App\Domain\Repositories\Interfaces\IStatusReportRepository;
use App\Http\Controllers\Controller;
use Illuminate\Support\Collection;

class StatusController extends Controller
{
    private IStatusReportRepository $statusReportRepository;

    public function __construct(IStatusReportRepository $statusReportRepository)
    {
        $this->statusReportRepository = $statusReportRepository;
    }

    public function update($serviceId)
    {
        // $service->updateStatusFor($serviceId);
        $reports = $this->statusReportRepository->findByServiceId($serviceId);
        $data = $this->getData($reports);
        return response()->json($data, 200);
    }

    private function getData(Collection $reports): array
    {
        return $reports->map(function (StatusReport $report) {
            return [
                'metadata' => $report->getMetadata(),
                'spec' => $report->getSpec(),
                'status' => $report->getStatus()
            ];
        })->toArray();
    }

}
