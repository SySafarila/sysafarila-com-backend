<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AllowedOrrigins
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $allowed = 'https://sysafarila.tech/';

        $origin = request()->server('HTTP_REFERER');
        $origin2 = $_SERVER['HTTP_REFERER'];

        if ($origin == $allowed) {
            return $next($request);
        } else {
            return response()->json([
                'message' => 'Your origin is blocked.',
                'status' => false,
                'origin' => $origin,
                'origin2' => $origin2
            ]);
        }
    }
}
