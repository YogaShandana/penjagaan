<?php

namespace App\Filament\Resources\ImsResource\Pages;

use App\Filament\Resources\ImsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditIms extends EditRecord
{
    protected static string $resource = ImsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}