<?php

namespace App\Filament\Resources\RekapanPenjagaResource\Pages;

use App\Filament\Resources\RekapanPenjagaResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewRekapanPenjaga extends ViewRecord
{
    protected static string $resource = RekapanPenjagaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Edit action dihapus karena rekapan tidak boleh diubah
        ];
    }
}