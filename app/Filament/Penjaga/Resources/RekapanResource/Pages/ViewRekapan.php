<?php

namespace App\Filament\Penjaga\Resources\RekapanResource\Pages;

use App\Filament\Penjaga\Resources\RekapanResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewRekapan extends ViewRecord
{
    protected static string $resource = RekapanResource::class;

    public function getTitle(): string
    {
        return 'Detail Rekapan Scan';
    }

    protected function getActions(): array
    {
        return [
            Actions\Action::make('back')
                ->label('Kembali')
                ->icon('heroicon-o-arrow-left')
                ->url(fn (): string => static::$resource::getUrl('index'))
                ->color('gray'),
        ];
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $record = $this->getRecord();
        
        $data['area'] = $record->scanned_type ? strtoupper($record->scanned_type) : 'UNKNOWN';
        
        if ($record->created_at) {
            $data['tanggal_scan'] = $record->created_at->setTimezone('Asia/Makassar')->format('d/m/Y');
            $data['jam_scan'] = $record->created_at->setTimezone('Asia/Makassar')->format('H:i:s');
        }

        if ($record->scanned_type === 'ims' && $record->scanned_id) {
            $ims = \App\Models\Ims::find($record->scanned_id);
            $data['nama_post'] = $ims ? $ims->nama_post : 'Data IMS tidak ditemukan';
        } elseif ($record->scanned_type === 'mjs' && $record->scanned_id) {
            $mjs = \App\Models\Mjs::find($record->scanned_id);
            $data['nama_post'] = $mjs ? $mjs->nama_post : 'Data MJS tidak ditemukan';
        } else {
            $data['nama_post'] = $record->nama_pos ?: 'Tidak Diketahui';
        }

        return $data;
    }
}