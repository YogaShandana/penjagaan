<?php

namespace App\Filament\Resources\MjsPenjagaResource\Pages;

use App\Filament\Resources\MjsPenjagaResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMjsPenjaga extends ListRecords
{
    protected static string $resource = MjsPenjagaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}