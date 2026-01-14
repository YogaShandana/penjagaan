<?php

namespace App\Filament\Resources\MjsResource\Pages;

use App\Filament\Resources\MjsResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewMjs extends ViewRecord
{
    protected static string $resource = MjsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}