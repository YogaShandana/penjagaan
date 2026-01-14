<?php

namespace App\Filament\Resources\MjsPenjagaResource\Pages;

use App\Filament\Resources\MjsPenjagaResource;
use Filament\Resources\Pages\CreateRecord;

class CreateMjsPenjaga extends CreateRecord
{
    protected static string $resource = MjsPenjagaResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}