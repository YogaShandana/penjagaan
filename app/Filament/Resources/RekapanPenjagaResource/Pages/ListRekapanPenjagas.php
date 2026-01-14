<?php

namespace App\Filament\Resources\RekapanPenjagaResource\Pages;

use App\Filament\Resources\RekapanPenjagaResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListRekapanPenjagas extends ListRecords
{
    protected static string $resource = RekapanPenjagaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            //
        ];
    }
}