<?php

namespace App\Filament\Resources\ImsResource\Pages;

use App\Filament\Resources\ImsResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListIms extends ListRecords
{
    protected static string $resource = ImsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}