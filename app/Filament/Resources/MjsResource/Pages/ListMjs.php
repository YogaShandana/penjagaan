<?php

namespace App\Filament\Resources\MjsResource\Pages;

use App\Filament\Resources\MjsResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMjs extends ListRecords
{
    protected static string $resource = MjsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}