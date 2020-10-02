<?php


namespace App\Domain\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StatusReport extends Model
{
    use SoftDeletes;

    protected $table = 'status_reports';

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
