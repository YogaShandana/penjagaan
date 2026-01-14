<?php

namespace App\Filament\Resources\MjsMesinResource\Pages;

use App\Filament\Resources\MjsMesinResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMjsMesin extends ListRecords
{
    protected static string $resource = MjsMesinResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}