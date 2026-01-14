<?php

namespace App\Filament\Resources\ImsMesinResource\Pages;

use App\Filament\Resources\ImsMesinResource;
use Filament\Resources\Pages\CreateRecord;

class CreateImsMesin extends CreateRecord
{
    protected static string $resource = ImsMesinResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}