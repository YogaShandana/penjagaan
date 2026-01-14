<?php

namespace App\Filament\Penjaga\Resources\ScanResource\Pages;

use App\Filament\Penjaga\Resources\ScanResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditScan extends EditRecord
{
    protected static string $resource = ScanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
