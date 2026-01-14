<?php

namespace App\Filament\Resources\ScanResource\Pages;

use App\Filament\Resources\ScanResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListScans extends ListRecords
{
    protected static string $resource = ScanResource::class;
    protected static ?string $title = 'Riwayat Scan QR';

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('scanQr')
                ->label('Scan QR Code')
                ->icon('heroicon-o-qr-code')
                ->color('primary')
                ->url(fn (): string => ScanResource::getUrl('scan')),
        ];
    }
}
