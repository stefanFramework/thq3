<?php


namespace App\Http\Api\Controllers;


use App\Http\Controllers\Controller;

class StatusController extends Controller
{
    public function update($serviceId)
    {
        $data = [
            'id' => $serviceId
        ];

        return response()->json($data, 200);
    }

}
