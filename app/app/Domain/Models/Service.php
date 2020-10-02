<?php


namespace App\Domain\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Service extends Model
{
    use SoftDeletes;

    protected $table = 'services';

    public function statusReport()
    {
        return $this->hasMany(StatusReport::class, 'service_id', 'id');
    }

}

