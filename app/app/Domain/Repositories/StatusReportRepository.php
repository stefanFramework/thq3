<?php


namespace App\Domain\Repositories;


use App\Domain\Models\StatusReport;
use App\Domain\Repositories\Interfaces\IStatusReportRepository;

class StatusReportRepository implements  IStatusReportRepository
{
    public function findByServiceId($serviceId)
    {
        return StatusReport::where('service_id', '=', $serviceId)
            ->orderBy('created_at', 'desc')
            ->get();
    }
}
