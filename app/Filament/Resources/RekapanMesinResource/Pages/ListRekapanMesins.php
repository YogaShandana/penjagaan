<?php

namespace App\Filament\Resources\RekapanMesinResource\Pages;

use App\Filament\Resources\RekapanMesinResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListRekapanMesins extends ListRecords
{
    protected static string $resource = RekapanMesinResource::class;

    protected function getHeaderActions(): array
    {
        return [
            //
        ];
    }
}