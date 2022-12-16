<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class isUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, $id, Closure $next)
    {

        $userId = auth()->user()->id;

        if ($userId != $id) {
            return response()->json([
                "success" => true,
                "message" => "No puedes pasaaaaaaar!"
            ]);
        }

        return $next($request);
    }
}
