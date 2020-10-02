<?php


namespace App\Http\Api\Controllers;

use App\Http\Controllers\Controller;

class ServiceController extends Controller
{
    public function index()
    {
        $data = [
            [
                'id' => 'logistics',
                'name' => 'Logistics Service',
                'team' => 'Kaiju',
                'version' => ''
            ],
            [
                'id' => 'stock-service',
                'name' => 'Stock Service',
                'team' => 'Kraken',
                'version' => ''
            ]
        ];

        return response()->json($data, 200);
    }
}
