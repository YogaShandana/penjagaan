<?php

namespace App\Filament\Penjaga\Resources\RekapanResource\Pages;

use App\Filament\Penjaga\Resources\RekapanResource;
use Filament\Resources\Pages\ListRecords;

class ListRekapans extends ListRecords
{
    protected static string $resource = RekapanResource::class;

    public function getTitle(): string
    {
        return 'Rekapan Scan Penjaga';
    }
}