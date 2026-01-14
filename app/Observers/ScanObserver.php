<?php

namespace App\Observers;

use App\Models\Scan;
use App\Models\Ims;
use App\Models\Mjs;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class ScanObserver
{
    public function creating(Scan $scan)
    {
        // SECURITY CHECK: Validate cross-role scanning
        if ($scan->qr_token && $scan->scanned_type && $scan->scanned_id) {
            
            if ($scan->scanned_type === 'ims') {
                $ims = Ims::find($scan->scanned_id);
                if ($ims) {
                    // Cek user role vs QR role
                    $user = Auth::user();
                    if ($user && $user->role) {
                        $userRole = $user->role->name;
                        $qrRole = $ims->role_type;
                        
                        // Normalisasi role untuk kompatibilitas
                        $normalizedUserRole = $userRole;
                        
                        // Mapping role penjagaan -> penjaga untuk kompatibilitas
                        if ($userRole === 'penjagaan') {
                            $normalizedUserRole = 'penjaga';
                        }
                        
                        // Hanya admin yang bisa scan cross-role
                        if ($userRole !== 'admin' && $normalizedUserRole !== $qrRole) {
                            Log::warning('SECURITY: Cross-role scan attempt blocked', [
                                'user_id' => $user->id,
                                'user_role' => $userRole,
                                'normalized_user_role' => $normalizedUserRole,
                                'qr_role' => $qrRole,
                                'qr_token' => $scan->qr_token,
                                'ip' => request()->ip()
                            ]);
                            
                            // Stop creation silently - error will be handled by CreateScan
                            return false;
                        }
                    }
                }
            }
            
            if ($scan->scanned_type === 'mjs') {
                $mjs = Mjs::find($scan->scanned_id);
                if ($mjs) {
                    // Cek user role vs QR role
                    $user = Auth::user();
                    if ($user && $user->role) {
                        $userRole = $user->role->name;
                        $qrRole = $mjs->role_type;
                        
                        // Normalisasi role untuk kompatibilitas
                        $normalizedUserRole = $userRole;
                        
                        // Mapping role penjagaan -> penjaga untuk kompatibilitas
                        if ($userRole === 'penjagaan') {
                            $normalizedUserRole = 'penjaga';
                        }
                        
                        // Hanya admin yang bisa scan cross-role
                        if ($userRole !== 'admin' && $normalizedUserRole !== $qrRole) {
                            Log::warning('SECURITY: Cross-role scan attempt blocked', [
                                'user_id' => $user->id,
                                'user_role' => $userRole,
                                'normalized_user_role' => $normalizedUserRole,
                                'qr_role' => $qrRole,
                                'qr_token' => $scan->qr_token,
                                'ip' => request()->ip()
                            ]);
                            
                            // Stop creation silently - error will be handled by CreateScan
                            return false;
                        }
                    }
                }
            }
        }
    }
}