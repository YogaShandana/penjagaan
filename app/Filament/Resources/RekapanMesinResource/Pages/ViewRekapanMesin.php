<?php

namespace App\Filament\Resources\RekapanMesinResource\Pages;

use App\Filament\Resources\RekapanMesinResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewRekapanMesin extends ViewRecord
{
    protected static string $resource = RekapanMesinResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Edit action dihapus karena rekapan tidak boleh diubah
        ];
    }
}