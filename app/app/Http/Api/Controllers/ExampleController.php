<?php

namespace App\Http\Api\Controllers;

use Throwable;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

use App\Http\Controllers\Controller;


class ExampleController extends Controller
{
    public function __construct() {}

    public function example(Request $request)
    {
        try {
            $inputData = $request->all();
            return response()->json([
                'title' => 'Example Title',
                'description' => 'This is the description of the title'
            ], 201);
        } catch(Throwable $ex) {
            Log::error('api.error', ['error' => $ex->getMessage()]);
            return response()->json(['error' => 'Unable to save message'], 500);
        }
        
    }

}