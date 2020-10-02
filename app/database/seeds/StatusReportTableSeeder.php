<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusReportTableSeeder extends Seeder
{
    private $table = 'status_reports';

    public function run()
    {
        DB::table($this->table)->insert([
            'service_id' => 'kaiju-backoffice',
            'payload' => '{"items":[{"metadata":{"name":"kaiju-backoffice","labels":{"app":"kaiju-backoffice","env":"stg","team":"cloud"},"annotations":{}},"spec":{"replicas":2,"template":{"spec":{"containers":[{"name":"kaiju-backoffice","image":"273512012034.dkr.ecr.us-east-1.amazonaws.com/web_br:latest","args":["start","kaiju","backoffice"]}]}}},"status":{"readyReplicas":2}}]}',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}
