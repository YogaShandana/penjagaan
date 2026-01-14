<?php

namespace App\Filament\Resources\RekapanMesinResource\Pages;

use App\Filament\Resources\RekapanMesinResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditRekapanMesin extends EditRecord
{
    protected static string $resource = RekapanMesinResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}