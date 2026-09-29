<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Closure;


class CheckAdmin
{
    public static function handle(Request $request, Closure $next)
    {
        $user = auth()->user();

        if (! $user) {
            return redirect()->route('login');
        }

        if ($user->is_admin) {
            return $next($request);
        }

        abort(403);

    }
}
