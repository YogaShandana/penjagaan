<?php

namespace App\Filament\Resources\ImsMesinResource\Pages;

use App\Filament\Resources\ImsMesinResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListImsMesin extends ListRecords
{
    protected static string $resource = ImsMesinResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}