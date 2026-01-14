<?php

namespace App\Filament\Resources\MjsPenjagaResource\Pages;

use App\Filament\Resources\MjsPenjagaResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewMjsPenjaga extends ViewRecord
{
    protected static string $resource = MjsPenjagaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Tidak ada tombol Edit di halaman View
        ];
    }
}