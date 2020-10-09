<?php


namespace App\Domain\Models;

use Illuminate\Database\Eloquent\Model;

class StatusReport extends Model
{

    protected $table = 'status_reports';

    public function getMetadata()
    {
        $data = $this->getData();
        return $data->metadata;
    }

    public function getSpec()
    {
        $data = $this->getData();
        return $data->spec;
    }

    public function getStatus()
    {
        $data = $this->getData();
        return $data->status;
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    private function getData()
    {
        return json_decode($this->payload);
    }
}
