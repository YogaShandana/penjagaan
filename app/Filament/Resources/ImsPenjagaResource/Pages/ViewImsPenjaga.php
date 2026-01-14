<?php

namespace App\Filament\Resources\ImsPenjagaResource\Pages;

use App\Filament\Resources\ImsPenjagaResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewImsPenjaga extends ViewRecord
{
    protected static string $resource = ImsPenjagaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Tidak ada tombol Edit di halaman View
        ];
    }
}