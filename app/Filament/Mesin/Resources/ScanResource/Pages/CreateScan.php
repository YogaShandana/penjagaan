<?php

namespace App\Filament\Mesin\Resources\ScanResource\Pages;

use App\Filament\Mesin\Resources\ScanResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Filament\Notifications\Notification;

class CreateScan extends CreateRecord
{
    protected static string $resource = ScanResource::class;
    
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // SECURITY CHECK - Pastikan hanya QR mesin yang bisa discan
        if (isset($data['qr_token'])) {
            $validIms = \App\Models\Ims::where('qr_token', $data['qr_token'])
                                     ->where('role_type', 'mesin')
                                     ->exists();
            
            $validMjs = \App\Models\Mjs::where('qr_token', $data['qr_token'])
                                     ->where('role_type', 'mesin')
                                     ->exists();
            
            if (!$validIms && !$validMjs) {
                // Log security attempt
                Log::warning('SECURITY: Unauthorized scan attempt in Mesin panel', [
                    'qr_token' => $data['qr_token'],
                    'user_id' => Auth::id(),
                    'ip' => request()->ip(),
                    'timestamp' => now()
                ]);
                
                // Show nice notification instead of exception
                Notification::make()
                    ->title('Scan Tidak Berhasil')
                    ->body('QR Code ini tidak dapat di-scan dan tidak sesuai.')
                    ->danger()
                    ->duration(6000)
                    ->icon('heroicon-o-x-circle')
                    ->send();
                
                $this->halt();
            }
        }
        
        // Double check status
        if (isset($data['status']) && $data['status'] === 'invalid') {
            Notification::make()
                ->title('Scan Tidak Valid')
                ->body('QR Code tidak dapat diproses. Pastikan menggunakan QR Code yang benar untuk Panel Mesin.')
                ->warning()
                ->duration(5000)
                ->icon('heroicon-o-exclamation-triangle')
                ->send();
                
            $this->halt();
        }
        
        $data['user_id'] = Auth::id();
        return $data;
    }
}
