<?php


namespace App\Domain\Services;


use App\Domain\Integrations\StatusReportApiClient;
use App\Domain\Models\StatusReport;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Log;
use Throwable;

class StatusReportUpdater
{
    private StatusReportApiClient $apiClient;

    public function __construct(StatusReportApiClient $statusReportApiClient)
    {
        $this->apiClient = $statusReportApiClient;
    }

    public function updateStatusFor(string $serviceId): void
    {
        try {
            $deploymentsInfo = $this->apiClient->getDeploymentsInfo();
            $this->saveUpdatedInfoForService($serviceId, $deploymentsInfo);
        } catch (Throwable $ex) {
            Log::error('status_report_updater', ['ex' => $ex]);
            throw $ex;
        }
    }

    private function saveUpdatedInfoForService($serviceId, $deploymentsInfo)
    {
        $deploymentInfo = array_filter($deploymentsInfo, function ($deploymentInfo) use ($serviceId) {
            return $deploymentInfo->metadata->name == $serviceId;
        });

        if (empty($deploymentInfo)) {
            throw new Exception('Invalid Service Id');
        }

        $info = array_values($deploymentInfo);
        $payload = $info[0];

        $statusReport = new StatusReport();
        $statusReport->service_id = $serviceId;
        $statusReport->payload = json_encode($payload);
        $statusReport->created_at = Carbon::now();
        $statusReport->updated_at = Carbon::now();
        $statusReport->save();
    }
}
