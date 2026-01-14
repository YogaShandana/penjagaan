<?php

namespace App\Filament\Resources\RekapanPenjagaResource\Pages;

use App\Filament\Resources\RekapanPenjagaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditRekapanPenjaga extends EditRecord
{
    protected static string $resource = RekapanPenjagaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}