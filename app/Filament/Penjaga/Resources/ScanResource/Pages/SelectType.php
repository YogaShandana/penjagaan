<?php

namespace App\Filament\Penjaga\Resources\ScanResource\Pages;

use App\Filament\Penjaga\Resources\ScanResource;
use Filament\Resources\Pages\Page;

class SelectType extends Page
{
    protected static string $resource = ScanResource::class;
    protected static string $view = 'filament.penjaga.resources.scan-resource.pages.select-type';
    protected static ?string $title = 'Pilih Jenis Scan';
    protected static ?string $navigationLabel = 'Scan QR';

    public function selectType(string $type)
    {
        return redirect()->to(route('filament.penjaga.resources.scans.scan', ['type' => $type]));
    }
}
