<?php

namespace App\Filament\Resources\MjsResource\Pages;

use App\Filament\Resources\MjsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMjs extends EditRecord
{
    protected static string $resource = MjsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}