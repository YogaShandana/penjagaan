<?php

namespace App\Filament\Resources\MjsMesinResource\Pages;

use App\Filament\Resources\MjsMesinResource;
use Filament\Resources\Pages\CreateRecord;

class CreateMjsMesin extends CreateRecord
{
    protected static string $resource = MjsMesinResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}