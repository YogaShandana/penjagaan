<?php

namespace App\Filament\Mesin\Resources;

use App\Filament\Mesin\Resources\RekapanResource\Pages;
use App\Models\Rekapan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class RekapanResource extends Resource
{
    protected static ?string $model = Rekapan::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $navigationLabel = 'Rekapan Scan';

    protected static ?string $modelLabel = 'Rekapan Scan';

    protected static ?string $pluralModelLabel = 'Rekapan Scan';

    protected static ?int $navigationSort = 20;
    
    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ])
            ->where('user_id', auth()->id())
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
                    ->label('Nama Mesin')
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
                Tables\Filters\SelectFilter::make('scanned_type')
                    ->label('Jenis')
                    ->options([
                        'ims' => 'IMS',
                        'mjs' => 'MJS'
                    ]),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
            ])
            ->bulkActions([
                //
            ])
            ->defaultSort('created_at', 'desc');
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRekapans::route('/'),
            'view' => Pages\ViewRekapan::route('/{record}'),
        ];
    }
}