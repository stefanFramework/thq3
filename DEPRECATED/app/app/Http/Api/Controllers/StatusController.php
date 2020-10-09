<?php


namespace App\Http\Api\Controllers;

use Exception;
use App\Domain\Models\StatusReport;
use App\Domain\Repositories\Interfaces\IStatusReportRepository;
use App\Domain\Services\StatusReportUpdater;
use App\Http\Controllers\Controller;
use Illuminate\Support\Collection;

class StatusController extends Controller
{
    private StatusReportUpdater $reportUpdater;
    private IStatusReportRepository $statusReportRepository;

    public function __construct(
        StatusReportUpdater $reportUpdater,
        IStatusReportRepository $statusReportRepository)
    {
        $this->reportUpdater = $reportUpdater;
        $this->statusReportRepository = $statusReportRepository;
    }

    public function update($serviceId)
    {
        try {
            $this->reportUpdater->updateStatusFor($serviceId);
            $reports = $this->statusReportRepository->findByServiceId($serviceId);
            $data = $this->getData($reports);
            return response()->json($data, 200);
        } catch (Exception $ex) {
            
        }
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
