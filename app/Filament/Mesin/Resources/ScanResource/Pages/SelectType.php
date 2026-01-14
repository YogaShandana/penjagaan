<?php

namespace App\Filament\Mesin\Resources\ScanResource\Pages;

use App\Filament\Mesin\Resources\ScanResource;
use Filament\Resources\Pages\Page;

class SelectType extends Page
{
    protected static string $resource = ScanResource::class;
    protected static string $view = 'filament.mesin.resources.scan-resource.pages.select-type';
    protected static ?string $title = 'Pilih Jenis Scan';
    protected static ?string $navigationLabel = 'Scan QR';

    public function selectType(string $type)
    {
        return redirect()->to(route('filament.mesin.resources.scans.scan', ['type' => $type]));
    }
}
