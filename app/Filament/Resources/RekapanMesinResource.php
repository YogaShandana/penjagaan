<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RekapanMesinResource\Pages;
use App\Models\Rekapan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Actions\BulkAction;
use Filament\Notifications\Notification;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Carbon\Carbon;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\StreamedResponse;

class RekapanMesinResource extends Resource
{
    protected static ?string $model = Rekapan::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $navigationGroup = 'Laporan';
    
    protected static ?string $navigationLabel = 'Rekapan Mesin';

    protected static ?string $modelLabel = 'Rekapan Mesin';

    protected static ?string $pluralModelLabel = 'Rekapan Mesin';
    
    protected static ?int $navigationSort = 32;
    
    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ])
            ->where(function (Builder $query) {
                $query->where(function (Builder $subQuery) {
                    $subQuery->where('scanned_type', 'ims')
                        ->whereHas('ims', function (Builder $imsQuery) {
                            $imsQuery->where('role_type', 'mesin');
                        });
                })
                ->orWhere(function (Builder $subQuery) {
                    $subQuery->where('scanned_type', 'mjs')
                        ->whereHas('mjs', function (Builder $mjsQuery) {
                            $mjsQuery->where('role_type', 'mesin');
                        });
                });
            });
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama_user')
                    ->label('Nama')
                    ->disabled()
                    ->formatStateUsing(fn ($record) => $record && $record->user ? $record->user->name : 'User tidak ditemukan'),
                Forms\Components\TextInput::make('area')
                    ->label('Area')
                    ->disabled()
                    ->formatStateUsing(fn ($record) => $record && $record->scanned_type ? strtoupper($record->scanned_type) : 'UNKNOWN'),
                Forms\Components\TextInput::make('tanggal_scan')
                    ->label('Tanggal Scan')
                    ->disabled()
                    ->formatStateUsing(fn ($record) => $record && $record->created_at ? $record->created_at->setTimezone('Asia/Makassar')->format('d/m/Y') : '-'),
                Forms\Components\TextInput::make('jam_scan')
                    ->label('Jam Scan')
                    ->disabled()
                    ->formatStateUsing(fn ($record) => $record && $record->created_at ? $record->created_at->setTimezone('Asia/Makassar')->format('H:i:s') : '-'),
                Forms\Components\TextInput::make('nama_post')
                    ->label('Nama Pos')
                    ->disabled()
                    ->formatStateUsing(function ($record) {
                        if (!$record) return '';
                        if ($record->scanned_type === 'ims' && $record->scanned_id) {
                            $ims = \App\Models\Ims::find($record->scanned_id);
                            return $ims ? $ims->nama_post : 'Data IMS tidak ditemukan';
                        } elseif ($record->scanned_type === 'mjs' && $record->scanned_id) {
                            $mjs = \App\Models\Mjs::find($record->scanned_id);
                            return $mjs ? $mjs->nama_post : 'Data MJS tidak ditemukan';
                        }
                        return $record->nama_pos ?: 'Tidak Diketahui';
                    }),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Nama')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('area')
                    ->label('Area')
                    ->getStateUsing(fn ($record) => $record->scanned_type ? strtoupper($record->scanned_type) : 'UNKNOWN')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'IMS' => 'success',
                        'MJS' => 'info',
                        default => 'gray',
                    })
                    ->sortable(),
                Tables\Columns\TextColumn::make('tanggal_scan')
                    ->label('Tanggal Scan')
                    ->getStateUsing(fn ($record) => $record->created_at ? $record->created_at->setTimezone('Asia/Makassar')->format('d/m/Y') : '-')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('jam_scan')
                    ->label('Jam Scan')
                    ->getStateUsing(fn ($record) => $record->created_at ? $record->created_at->setTimezone('Asia/Makassar')->format('H:i') : '-')
                    ->sortable(),
                Tables\Columns\TextColumn::make('nama_post')
                    ->label('Nama Pos')
                    ->searchable()
                    ->limit(30)
                    ->getStateUsing(function ($record) {
                        if ($record->scanned_type === 'ims' && $record->scanned_id) {
                            $ims = \App\Models\Ims::find($record->scanned_id);
                            return $ims ? $ims->nama_post : 'Data IMS tidak ditemukan';
                        } elseif ($record->scanned_type === 'mjs' && $record->scanned_id) {
                            $mjs = \App\Models\Mjs::find($record->scanned_id);
                            return $mjs ? $mjs->nama_post : 'Data MJS tidak ditemukan';
                        }
                        return $record->nama_pos ?: 'Tidak Diketahui';
                    }),
            ])
            ->filters([
                Tables\Filters\Filter::make('created_at')
                    ->form([
                        Forms\Components\DatePicker::make('created_from')
                            ->label('Dari Tanggal')
                            ->timezone('Asia/Makassar'),
                        Forms\Components\DatePicker::make('created_until')
                            ->label('Sampai Tanggal')
                            ->timezone('Asia/Makassar'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['created_from'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date),
                            )
                            ->when(
                                $data['created_until'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date),
                            );
                    })
                    ->indicateUsing(function (array $data): array {
                        $indicators = [];
                        if ($data['created_from'] ?? null) {
                            $indicators['created_from'] = 'Dari: ' . Carbon::parse($data['created_from'])->format('d/m/Y');
                        }
                        if ($data['created_until'] ?? null) {
                            $indicators['created_until'] = 'Sampai: ' . Carbon::parse($data['created_until'])->format('d/m/Y');
                        }
                        return $indicators;
                    }),
                Tables\Filters\SelectFilter::make('scanned_type')
                    ->label('Area')
                    ->options([
                        'ims' => 'IMS',
                        'mjs' => 'MJS',
                    ]),
                Tables\Filters\SelectFilter::make('user_id')
                    ->label('User')
                    ->relationship('user', 'name')
                    ->searchable(),
                Tables\Filters\SelectFilter::make('status_hapus')
                    ->label('Status Hapus')
                    ->options([
                        'terhapus' => 'Data Terhapus', 
                        'semua' => 'Semua Data',
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return match ($data['value'] ?? 'normal') {
                            'terhapus' => $query->onlyTrashed(),
                            'semua' => $query->withTrashed(),
                            default => $query->withoutTrashed(),
                        };
                    }),
            ])
            ->headerActions([
                Tables\Actions\Action::make('export')
                    ->label('Export Excel')
                    ->icon('heroicon-o-document-arrow-down')
                    ->action(function ($livewire) {
                        $data = $livewire->getFilteredTableQuery()->get();
                        return static::exportToExcel($data);
                    }),
            ])
            ->actions([
                Tables\Actions\ViewAction::make()
                    ->label('Lihat'),
                Tables\Actions\DeleteAction::make()
                    ->label('Hapus'),
                Tables\Actions\RestoreAction::make()
                    ->label('Pulihkan'),
                Tables\Actions\ForceDeleteAction::make()
                    ->label('Hapus Permanen'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc')
            ->emptyStateHeading('Belum Ada Data Scan Mesin')
            ->emptyStateDescription('Data scan QR Code area mesin akan muncul di sini setelah ada yang melakukan scan.')
            ->emptyStateIcon('heroicon-o-qr-code');
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    protected static function exportToExcel($data): \Symfony\Component\HttpFoundation\StreamedResponse
    {
        $filename = 'rekapan_mesin_' . now()->format('Y-m-d_H-i-s') . '.csv';
        
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function () use ($data) {
            $file = fopen('php://output', 'w');
            
            // Add BOM for UTF-8
            fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));
            
            // Header
            fputcsv($file, [
                'Nama',
                'Area', 
                'Tanggal Scan',
                'Jam Scan',
                'Nama Pos'
            ]);

            foreach ($data as $record) {
                $namaPos = '';
                if ($record->scanned_type === 'ims' && $record->scanned_id) {
                    $ims = \App\Models\Ims::find($record->scanned_id);
                    $namaPos = $ims ? $ims->nama_post : 'Data IMS tidak ditemukan';
                } elseif ($record->scanned_type === 'mjs' && $record->scanned_id) {
                    $mjs = \App\Models\Mjs::find($record->scanned_id);
                    $namaPos = $mjs ? $mjs->nama_post : 'Data MJS tidak ditemukan';
                } else {
                    $namaPos = $record->nama_pos ?: 'Tidak Diketahui';
                }
                
                fputcsv($file, [
                    $record->user ? $record->user->name : 'N/A',
                    $record->scanned_type ? strtoupper($record->scanned_type) : 'UNKNOWN',
                    $record->created_at ? $record->created_at->setTimezone('Asia/Makassar')->format('d/m/Y') : '-',
                    $record->created_at ? $record->created_at->setTimezone('Asia/Makassar')->format('H:i:s') : '-',
                    $namaPos
                ]);
            }

            fclose($file);
        };

        return new \Symfony\Component\HttpFoundation\StreamedResponse($callback, 200, $headers);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRekapanMesins::route('/'),
            'create' => Pages\CreateRekapanMesin::route('/create'),
            'view' => Pages\ViewRekapanMesin::route('/{record}'),
            'edit' => Pages\EditRekapanMesin::route('/{record}/edit'),
        ];
    }
}