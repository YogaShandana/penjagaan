<?php

namespace App\Filament\Resources\ImsPenjagaResource\Pages;

use App\Filament\Resources\ImsPenjagaResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListImsPenjaga extends ListRecords
{
    protected static string $resource = ImsPenjagaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}