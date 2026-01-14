<?php

namespace App\Filament\Resources\MjsPenjagaResource\Pages;

use App\Filament\Resources\MjsPenjagaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMjsPenjaga extends EditRecord
{
    protected static string $resource = MjsPenjagaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('regenerateQR')
                ->label('Ubah QR')
                ->icon('heroicon-o-arrow-path')
                ->color('warning')
                ->requiresConfirmation()
                ->modalHeading('Ubah QR Code')
                ->modalDescription('QR Code akan dibuat ulang secara otomatis. Apakah Anda yakin?')
                ->action(function ($record) {
                    // Gunakan method regenerateQrCode dari model
                    $record->regenerateQrCode();
                    
                    \Filament\Notifications\Notification::make()
                        ->title('QR Code berhasil dibuat ulang')
                        ->body('Token baru: ' . $record->qr_token)
                        ->success()
                        ->send();
                }),
            Actions\DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}