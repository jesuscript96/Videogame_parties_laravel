<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;

class isAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $userRole = auth()->user()->role;

        // dd($userRole);

        // $user = User::find($userId);
        // $isAdminRole = $user->roles->contains(3);


        if($userRole != "1") {
            return response()->json([
                "success" => true,
                "message" => "No puedes pasaaaaaaar!"
            ]);
        }

        return $next($request);
    }
}
