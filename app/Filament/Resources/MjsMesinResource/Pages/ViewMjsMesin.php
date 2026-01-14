<?php

namespace App\Filament\Resources\MjsMesinResource\Pages;

use App\Filament\Resources\MjsMesinResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewMjsMesin extends ViewRecord
{
    protected static string $resource = MjsMesinResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Tidak ada tombol Edit di halaman View
        ];
    }
}