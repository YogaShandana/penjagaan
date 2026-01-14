<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ImsResource\Pages;
use App\Filament\Resources\ImsResource\RelationManagers;
use App\Models\Ims;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ImsResource extends Resource
{
    protected static ?string $model = Ims::class;

    protected static ?string $navigationIcon = 'heroicon-o-qr-code';
    protected static ?string $navigationGroup = 'IMS';
    protected static ?int $navigationSort = 0;
    protected static bool $shouldRegisterNavigation = false;
    
    protected static ?string $label = 'IMS (Semua)';
    protected static ?string $pluralLabel = 'IMS (Semua)';

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
                        if ($record && $record->qr_code) {
                            return new \Illuminate\Support\HtmlString(
                                '<div style="max-width: 200px; border: 1px solid #e5e7eb; border-radius: 8px; padding: 10px;">' 
                                . base64_decode($record->qr_code) . 
                                '</div><p class="text-sm text-gray-600 mt-2">Token: ' . $record->qr_token . '</p>'
                            );
                        }
                        return 'Kode QR akan dibuat otomatis setelah data disimpan';
                    })
                    ->visibleOn('edit'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nomor_urut')
                    ->label('Nomor Urut')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('nama_post')
                    ->label('Nama Post')
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
            ])
            ->defaultSort('nomor_urut')
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make()
                    ->label('Lihat'),
                Tables\Actions\EditAction::make()
                    ->label('Edit'),
                Tables\Actions\Action::make('downloadQR')
                    ->label('Unduh QR')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->action(function ($record) {
                        if (!$record->qr_code) {
                            \Filament\Notifications\Notification::make()
                                ->title('Kode QR belum tersedia')
                                ->danger()
                                ->send();
                            return;
                        }
                        
                        try {
                            $svgContent = base64_decode($record->qr_code);
                            $fileName = 'qr-' . $record->nomor_urut . '.svg';
                            
                            return response()->streamDownload(function () use ($svgContent) {
                                echo $svgContent;
                            }, $fileName, [
                                'Content-Type' => 'image/svg+xml',
                            ]);
                        } catch (\Exception $e) {
                            \Filament\Notifications\Notification::make()
                                ->title('Gagal mengunduh Kode QR')
                                ->body('Terjadi kesalahan: ' . $e->getMessage())
                                ->danger()
                                ->send();
                        }
                    }),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
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
            'index' => Pages\ListIms::route('/'),
            'create' => Pages\CreateIms::route('/create'),
            'view' => Pages\ViewIms::route('/{record}'),
            'edit' => Pages\EditIms::route('/{record}/edit'),
        ];
    }
}
