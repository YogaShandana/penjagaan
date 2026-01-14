<?php

namespace App\Filament\Penjaga\Resources;

use App\Filament\Penjaga\Resources\ScanResource\Pages;
use App\Models\Scan;
use App\Models\Ims;
use App\Models\Mjs;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Notifications\Notification;

class ScanResource extends Resource
{
    protected static ?string $model = Scan::class;
    protected static ?string $navigationIcon = 'heroicon-o-qr-code';
    protected static ?string $navigationLabel = 'Scan QR';
    protected static ?string $modelLabel = 'Scan QR';
    protected static ?string $pluralModelLabel = 'Scan QR';
    protected static ?string $recordTitleAttribute = 'nama_pos';
    protected static ?int $navigationSort = 10;
    
    public static function getNavigationUrl(array $parameters = []): string
    {
        return static::getUrl('select-type', $parameters);
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('qr_token')
                    ->label('Token QR')
                    ->required()
                    ->maxLength(255)
                    ->reactive()
                    ->afterStateUpdated(function ($state, callable $set) {
                        if ($state) {
                            // Cari di tabel IMS dengan role penjaga saja
                            $ims = Ims::where('qr_token', $state)
                                     ->where('role_type', 'penjaga')
                                     ->first();
                            if ($ims) {
                                $set('scanned_type', 'ims');
                                $set('scanned_id', $ims->id);
                                $set('nama_pos', $ims->nama_post);
                                $set('nomor_urut', $ims->nomor_urut);
                                $set('status', 'valid');
                                return;
                            }
                            
                            // Cari di tabel MJS dengan role penjaga saja
                            $mjs = Mjs::where('qr_token', $state)
                                     ->where('role_type', 'penjaga')
                                     ->first();
                            if ($mjs) {
                                $set('scanned_type', 'mjs');
                                $set('scanned_id', $mjs->id);
                                $set('nama_pos', $mjs->nama_post);
                                $set('nomor_urut', $mjs->nomor_urut);
                                $set('status', 'valid');
                                return;
                            }
                            
                            // Jika tidak ditemukan atau bukan role penjaga
                            $set('scanned_type', null);
                            $set('scanned_id', null);
                            $set('nama_pos', 'AKSES DITOLAK: QR Code ini bukan untuk role penjaga!');
                            $set('nomor_urut', null);
                            $set('status', 'invalid');
                            
                            // BLOKIR TOTAL - Reset form dan show notification
                            Notification::make()
                                ->title('Scan Tidak Berhasil')
                                ->body('QR Code ini tidak dapat di-scan dan tidak sesuai.')
                                ->danger()
                                ->duration(6000)
                                ->icon('heroicon-o-x-circle')
                                ->send();
                            
                            // Reset form untuk mencegah submit
                            $set('qr_token', null);
                            return;
                        }
                    }),
                    
                Select::make('scanned_type')
                    ->label('Jenis')
                    ->options([
                        'ims' => 'IMS',
                        'mjs' => 'MJS'
                    ])
                    ->disabled(),
                    
                TextInput::make('nama_pos')
                    ->label('Nama Pos')
                    ->disabled(),
                    
                TextInput::make('nomor_urut')
                    ->label('Nomor Urut')
                    ->disabled(),
                    
                Select::make('status')
                    ->label('Status')
                    ->options([
                        'valid' => 'Valid',
                        'invalid' => 'Tidak Valid'
                    ])
                    ->readonly()
                    ->required()
                    ->rules([
                        'required',
                        'in:valid', // Hanya boleh valid untuk panel penjaga
                        function ($get) {
                            return function (string $attribute, $value, \Closure $fail) use ($get) {
                                if ($value === 'invalid') {
                                    $fail('QR Code tidak valid untuk role penjaga. Scan tidak dapat dilanjutkan.');
                                }
                                
                                // Double check QR token
                                $qrToken = $get('qr_token');
                                if ($qrToken) {
                                    $validIms = \App\Models\Ims::where('qr_token', $qrToken)->where('role_type', 'penjaga')->exists();
                                    $validMjs = \App\Models\Mjs::where('qr_token', $qrToken)->where('role_type', 'penjaga')->exists();
                                    
                                    if (!$validIms && !$validMjs) {
                                        $fail('AKSES DITOLAK: QR Code ini bukan milik role penjaga.');
                                    }
                                }
                            };
                        },
                    ]),
                    
                Textarea::make('keterangan')
                    ->label('Keterangan')
                    ->rows(3),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->label('ID')
                    ->sortable(),
                    
                TextColumn::make('scanned_type')
                    ->label('Jenis')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'ims' => 'success',
                        'mjs' => 'info',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn (string $state): string => strtoupper($state)),
                    
                TextColumn::make('nama_pos')
                    ->label('Nama Pos')
                    ->searchable()
                    ->sortable(),
                    
                TextColumn::make('nomor_urut')
                    ->label('Nomor Urut')
                    ->searchable()
                    ->sortable(),
                    
                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'valid' => 'success',
                        'invalid' => 'danger',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'valid' => 'Valid',
                        'invalid' => 'Tidak Valid',
                        default => $state,
                    }),
                    
                TextColumn::make('user.name')
                    ->label('Discan Oleh')
                    ->searchable()
                    ->sortable(),
                    
                TextColumn::make('created_at')
                    ->label('Waktu Scan')
                    ->dateTime('d M Y H:i:s')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('scanned_type')
                    ->label('Jenis')
                    ->options([
                        'ims' => 'IMS',
                        'mjs' => 'MJS'
                    ]),
                    
                Tables\Filters\SelectFilter::make('status')
                    ->label('Status')
                    ->options([
                        'valid' => 'Valid',
                        'invalid' => 'Tidak Valid'
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
            'index' => Pages\ListScans::route('/history'),
            'create' => Pages\CreateScan::route('/create'),
            'select-type' => Pages\SelectType::route('/'),
            'scan' => Pages\ScanQr::route('/scan/{type}'),
            'edit' => Pages\EditScan::route('/{record}/edit'),
        ];
    }
}
