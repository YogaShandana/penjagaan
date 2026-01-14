<?php

namespace App\Filament\Resources\ImsPenjagaResource\Pages;

use App\Filament\Resources\ImsPenjagaResource;
use Filament\Resources\Pages\CreateRecord;

class CreateImsPenjaga extends CreateRecord
{
    protected static string $resource = ImsPenjagaResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}