<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckPenjagaRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            return redirect('/penjaga/login');
        }

        $user = Auth::user();
        if ($user->role && $user->role->name !== 'penjagaan') {
            Auth::logout();
            return redirect('/penjaga/login')->with('error', 'Anda tidak memiliki akses ke panel penjaga.');
        }

        return $next($request);
    }
}
