<?php

namespace App\Filament\Resources\ScanResource\Pages;

use App\Filament\Resources\ScanResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;

class CreateScan extends CreateRecord
{
    protected static string $resource = ScanResource::class;
    
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user_id'] = Auth::id();
        
        return $data;
    }
}
