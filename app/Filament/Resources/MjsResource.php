<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MjsResource\Pages;
use App\Filament\Resources\MjsResource\RelationManagers;
use App\Models\Mjs;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MjsResource extends Resource
{
    protected static ?string $model = Mjs::class;

    protected static ?string $navigationIcon = 'heroicon-o-qr-code';
    protected static ?string $navigationGroup = 'MJS';
    protected static ?int $navigationSort = 0;
    protected static bool $shouldRegisterNavigation = false;
    
    protected static ?string $label = 'MJS (Semua)';
    protected static ?string $pluralLabel = 'MJS (Semua)';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama_post')
                    ->label('Nama Pos')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('nomor_urut')
                    ->label('Nomor Urut')
                    ->required()
                    ->numeric()
                    ->unique(ignoreRecord: true),
                Forms\Components\Select::make('role_type')
                    ->label('Jenis Role')
                    ->options([
                        'penjaga' => 'Penjaga',
                        'mesin' => 'Mesin',
                    ])
                    ->required()
                    ->default('penjaga'),
                Forms\Components\Placeholder::make('qr_preview')
                    ->label('Kode QR')
                    ->content(function ($record) {
                        if ($record && $record->qr_token) {
                            $qrUrl = "https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=" . urlencode($record->qr_token);
                            return new \Illuminate\Support\HtmlString(
                                '<div class="text-center">
                                    <img src="' . $qrUrl . '" alt="QR Code" class="mx-auto mb-2" style="max-width: 200px;">
                                    <p class="text-sm text-gray-600 font-mono break-all">' . $record->qr_token . '</p>
                                </div>'
                            );
                        }
                        return 'QR akan dibuat setelah menyimpan data.';
                    }),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('ID')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('nama_post')
                    ->label('Nama Pos')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('nomor_urut')
                    ->label('Nomor Urut')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('qr_token')
                    ->label('QR Token')
                    ->limit(20)
                    ->tooltip(fn ($record) => $record->qr_token)
                    ->fontFamily('mono')
                    ->size('sm'),
                Tables\Columns\TextColumn::make('role_type')
                    ->label('Role')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'penjaga' => 'success',
                        'mesin' => 'info',
                        default => 'gray',
                    }),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Diupdate')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('role_type')
                    ->label('Role')
                    ->options([
                        'penjaga' => 'Penjaga',
                        'mesin' => 'Mesin',
                    ]),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('nomor_urut', 'asc');
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
            'index' => Pages\ListMjs::route('/'),
            'create' => Pages\CreateMjs::route('/create'),
            'view' => Pages\ViewMjs::route('/{record}'),
            'edit' => Pages\EditMjs::route('/{record}/edit'),
        ];
    }
}
