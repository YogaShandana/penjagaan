<?php

namespace App\Filament\Resources\ImsMesinResource\Pages;

use App\Filament\Resources\ImsMesinResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewImsMesin extends ViewRecord
{
    protected static string $resource = ImsMesinResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Tidak ada tombol Edit di halaman View
        ];
    }
}