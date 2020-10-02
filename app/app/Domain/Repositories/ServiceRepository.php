<?php


namespace App\Domain\Repositories;


use App\Domain\Models\Service;
use App\Domain\Repositories\Interfaces\IServiceRepository;

class ServiceRepository implements IServiceRepository
{
    public function findById(string $id)
    {
        return Service::find($id);
    }

    public function findAll()
    {
        return Service::all();
    }
}
