<?php
namespace App\Http\Middleware;
use Closure;

class Cors
{
    
    public function handle($request, Closure $next)
    {
        // ALLOW OPTIONS METHOD
        $headers = [
            'Access-Control-Allow-Origin' => '*',
            'Access-Control-Allow-Methods' => 'POST, GET, OPTIONS, PUT, DELETE',
            'Access-Control-Allow-Headers' => 'Content-Type, X-Auth-Token, Origin, Authorization, Accept, X-Requested-With',
        ];
        
        if ($request->getMethod() == "OPTIONS") {
            return response('', 200)->withHeaders($headers);
        }

        $response = $next($request);
        
        foreach ($headers as $key => $value)
            $response->header($key, $value);
            
        return $response;
    }
}