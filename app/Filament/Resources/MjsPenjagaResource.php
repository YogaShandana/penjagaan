<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MjsPenjagaResource\Pages;
use App\Models\Mjs;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class MjsPenjagaResource extends Resource
{
    protected static ?string $model = Mjs::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-circle';
    
    protected static ?string $label = 'MJS Penjaga';
    protected static ?string $pluralLabel = 'MJS Penjaga';
    protected static ?string $navigationGroup = 'QR Code MJS';
    protected static ?int $navigationSort = 1;

    // Only show records for penjaga role
    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('role_type', 'penjaga');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama_post')
                    ->label('Nama Pos Penjaga')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('nomor_urut')
                    ->label('Nomor Urut')
                    ->required()
                    ->numeric()
                    ->unique(
                        table: 'mjs',
                        column: 'nomor_urut',
                        ignoreRecord: true,
                        modifyRuleUsing: function (\Illuminate\Validation\Rules\Unique $rule) {
                            return $rule->where('role_type', 'penjaga');
                        }
                    ),
                Forms\Components\Hidden::make('role_type')
                    ->default('penjaga'),
                Forms\Components\Placeholder::make('qr_preview')
                    ->label('Kode QR Penjaga')
                    ->content(function ($record) {
                        if ($record && $record->qr_code) {
                            return new \Illuminate\Support\HtmlString(
                                '<div class="bg-white p-4 rounded-lg border border-gray-200 shadow-sm" style="max-width: 250px;">' 
                                . '<div class="text-center mb-3">' . base64_decode($record->qr_code) . '</div>'
                                . '<div class="space-y-1 text-sm">'
                                . '<p class="text-gray-700"><strong>Token:</strong> <code class="bg-gray-100 px-1 rounded">' . $record->qr_token . '</code></p>'
                                . '<p class="text-green-600"><strong>Role:</strong> Penjaga</p>'
                                . '<p class="text-purple-600"><strong>Nomor Urut:</strong> ' . $record->nomor_urut . '</p>'
                                . '</div></div>'
                            );
                        }
                        return '<p class="text-gray-500 italic">Kode QR akan dibuat otomatis setelah data disimpan</p>';
                    })
                    ->visibleOn(['edit', 'view']),
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
                    ->label('Nama Pos Penjaga')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('qr_token')
                    ->label('Token QR')
                    ->limit(20)
                    ->tooltip(fn ($record) => $record->qr_token)
                    ->fontFamily('mono')
                    ->size('sm'),
                Tables\Columns\TextColumn::make('role_type')
                    ->label('Role')
                    ->badge()
                    ->color('success'),
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
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
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
                        
                        $svgContent = base64_decode($record->qr_code);
                        $fileName = 'qr-mjs-penjaga-' . $record->nomor_urut . '.svg';
                        
                        return response()->streamDownload(function () use ($svgContent) {
                            echo $svgContent;
                        }, $fileName, [
                            'Content-Type' => 'image/svg+xml',
                        ]);
                    })
                    ->color('primary'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMjsPenjaga::route('/'),
            'create' => Pages\CreateMjsPenjaga::route('/create'),
            'view' => Pages\ViewMjsPenjaga::route('/{record}'),
            'edit' => Pages\EditMjsPenjaga::route('/{record}/edit'),
        ];
    }
}