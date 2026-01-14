<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Ims;
use App\Models\Mjs;

class BlockCrossRoleScan
{
    public function handle(Request $request, Closure $next)
    {
        // Hanya apply untuk create scan di panel mesin/penjaga
        if ($request->routeIs('filament.mesin.*') && $request->method() === 'POST') {
            $qrToken = $request->input('qr_token');
            
            if ($qrToken) {
                // Cek apakah QR adalah milik mesin
                $validForMesin = Ims::where('qr_token', $qrToken)->where('role_type', 'mesin')->exists() ||
                                Mjs::where('qr_token', $qrToken)->where('role_type', 'mesin')->exists();
                
                if (!$validForMesin) {
                    return response()->json([
                        'error' => 'MIDDLEWARE BLOCK: QR Code tidak diizinkan untuk Panel Mesin'
                    ], 403);
                }
            }
        }
        
        if ($request->routeIs('filament.penjaga.*') && $request->method() === 'POST') {
            $qrToken = $request->input('qr_token');
            
            if ($qrToken) {
                // Cek apakah QR adalah milik penjaga
                $validForPenjaga = Ims::where('qr_token', $qrToken)->where('role_type', 'penjaga')->exists() ||
                                  Mjs::where('qr_token', $qrToken)->where('role_type', 'penjaga')->exists();
                
                if (!$validForPenjaga) {
                    return response()->json([
                        'error' => 'MIDDLEWARE BLOCK: QR Code tidak diizinkan untuk Panel Penjaga'  
                    ], 403);
                }
            }
        }
        
        return $next($request);
    }
}