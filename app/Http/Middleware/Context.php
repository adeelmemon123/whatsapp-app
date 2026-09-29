<?php

namespace App\Http\Middleware;

use App\Models\User;
use Illuminate\Http\Request;
use Closure;
use Config;

class Context
{
    public static function handle(Request $request, Closure $next)
    {
        $segments = $request->segments();

        if (in_array('admin', $segments)) {
            Config::set('web_context', true);
        } else {

            Config::set('web_context', false);
        }

        return $next($request);
    }
}