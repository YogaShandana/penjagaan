<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckMesinRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            return redirect('/mesin/login');
        }

        $user = Auth::user();
        if ($user->role && $user->role->name !== 'mesin') {
            Auth::logout();
            return redirect('/mesin/login')->with('error', 'Anda tidak memiliki akses ke panel mesin.');
        }

        return $next($request);
    }
}
