<?php

namespace App\Filament\Mesin\Resources\RekapanResource\Pages;

use App\Filament\Mesin\Resources\RekapanResource;
use Filament\Resources\Pages\ListRecords;

class ListRekapans extends ListRecords
{
    protected static string $resource = RekapanResource::class;

    public function getTitle(): string
    {
        return 'Rekapan Scan Mesin';
    }
}