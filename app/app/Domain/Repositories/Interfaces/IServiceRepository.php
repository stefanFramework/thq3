<?php


namespace App\Domain\Repositories\Interfaces;


interface IServiceRepository
{
    public function findById(string $id);

    public function findAll();
}
