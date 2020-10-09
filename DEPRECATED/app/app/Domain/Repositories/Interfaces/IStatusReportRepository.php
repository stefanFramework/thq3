<?php


namespace App\Domain\Repositories\Interfaces;


interface IStatusReportRepository
{
    public function findByServiceId($serviceId);
}
