<?php
namespace App\Http\Api\Middleware;

use Closure;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class MiddlewareExample
{
    public function handle(Request $request, Closure $next)
    {
        try {
            $headerValue = $request->header('some-field');
            return $next($request);
        } catch (\Throwable $ex) {
            return Response::json([], 401);
        }
    }
}
