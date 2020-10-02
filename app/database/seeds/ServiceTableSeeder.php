<?php

use Illuminate\Database\Seeder;

use Carbon\Carbon;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\DB;

class ServiceTableSeeder extends Seeder
{
    protected $table = 'services';

    public function run(Faker $faker)
    {
        DB::table($this->table)->insert([
            'id' => 'kaiju-backoffice',
            'name' => 'Logistics Service',
            'team' => 'Kaiju',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table($this->table)->insert([
            'id' => 'stock',
            'name' => 'Stock Service',
            'team' => 'Kraken',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}
