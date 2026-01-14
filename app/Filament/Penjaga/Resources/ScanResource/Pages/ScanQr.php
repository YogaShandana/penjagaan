<?php

namespace App\Filament\Penjaga\Resources\ScanResource\Pages;

use App\Filament\Penjaga\Resources\ScanResource;
use App\Models\Scan;
use App\Models\Ims;
use App\Models\Mjs;
use Filament\Resources\Pages\Page;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Form;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Auth;

class ScanQr extends Page
{
    protected static string $resource = ScanResource::class;
    protected static string $view = 'filament.penjaga.resources.scan-resource.pages.scan-qr';
    protected static ?string $title = 'Scan QR Code';
    protected static ?string $navigationLabel = 'Scan QR';

    public ?array $data = [];
    public $qrToken = '';
    public $scanResult = null;
    public $keterangan = '';
    public ?string $type = null;

    protected $listeners = ['qrScanned' => 'handleQrScanned'];

    public function mount(?string $type = null): void
    {
        $this->type = $type;
        
        // Redirect ke halaman select type jika type tidak ada
        if (!$this->type || !in_array($this->type, ['ims', 'mjs'])) {
            redirect()->to(route('filament.admin.resources.scans.select-type'));
            return;
        }
        
        $this->form->fill();
    }
    
    public function getTitle(): string
    {
        if ($this->type === 'ims') {
            return 'Scan QR Code - IMS';
        } elseif ($this->type === 'mjs') {
            return 'Scan QR Code - MJS';
        }
        return 'Scan QR Code';
    }

    public function qrScanned($token)
    {
        $this->handleQrScanned($token);
    }

    public function handleQrScanned($token)
    {
        $this->qrToken = $token;
        $this->data['qrToken'] = $token;
        $this->processQrScan();
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('qrToken')
                    ->label('Masukkan Token QR atau Scan QR Code')
                    ->placeholder('Ketik atau scan QR token')
                    ->live(onBlur: true)
                    ->required()
                    ->afterStateUpdated(function ($state) {
                        $this->qrToken = $state;
                        $this->processQrScan();
                    }),
                    
                Textarea::make('keterangan')
                    ->label('Keterangan')
                    ->placeholder('Tambahkan keterangan jika diperlukan')
                    ->rows(3)
                    ->columnSpanFull(),
            ])
            ->statePath('data')
            ->columns(2);
    }

    public function updatedQrToken($value)
    {
        $this->data['qrToken'] = $value;
        $this->processQrScan();
    }

    public function processQrScan()
    {
        if (empty($this->qrToken)) {
            $this->scanResult = null;
            return;
        }

        // Clean the token - extract UUID if needed
        $cleanToken = $this->extractTokenFromQrData($this->qrToken);
        
        // SECURITY CHECK: Pastikan hanya QR role penjaga yang bisa diproses
        $isValidForPenjaga = false;
        if ($this->type === 'ims') {
            $isValidForPenjaga = Ims::where('qr_token', $cleanToken)->where('role_type', 'penjaga')->exists();
        } elseif ($this->type === 'mjs') {
            $isValidForPenjaga = Mjs::where('qr_token', $cleanToken)->where('role_type', 'penjaga')->exists();
        }
        
        if (!$isValidForPenjaga) {
            // Security block - QR bukan role penjaga
            // Only show notification once per minute to prevent spam
            $cacheKey = 'invalid_qr_notification_' . Auth::id() . '_' . md5($cleanToken);
            if (!cache()->has($cacheKey)) {
                Notification::make()
                    ->title('Scan Tidak Berhasil')
                    ->body('QR Code ini tidak dapat di-scan dan tidak sesuai.')
                    ->danger()
                    ->duration(6000)
                    ->icon('heroicon-o-x-circle')
                    ->send();
                
                // Cache for 1 minute to prevent spam
                cache()->put($cacheKey, true, 60);
            }
                
            // Send invalid response to JavaScript
            $this->dispatch('scan-invalid-type', 'QR Code tidak sesuai untuk area penjaga');
                
            // Reset form
            $this->qrToken = '';
            $this->data['qrToken'] = '';
            return;
        }

        // Check for recent duplicate scan (within last 30 seconds) to prevent spam
        $recentScan = Scan::where('qr_token', $cleanToken)
            ->where('user_id', Auth::id())
            ->where('created_at', '>', now()->subSeconds(30))
            ->first();

        if ($recentScan) {
            // Show warning for duplicate scan
            Notification::make()
                ->title('QR Code sudah di-scan!')
                ->body('QR Code ini baru saja di-scan ' . $recentScan->created_at->diffForHumans())
                ->warning()
                ->send();
            return;
        }

        // Scan based on selected type
        if ($this->type === 'ims') {
            $this->scanIms($cleanToken);
        } elseif ($this->type === 'mjs') {
            $this->scanMjs($cleanToken);
        }
    }

    private function scanIms($cleanToken)
    {
        // Cek apakah QR ini adalah QR MJS (salah pilih)
        $mjs = Mjs::where('qr_token', $cleanToken)->first();
        if ($mjs) {
            $this->scanResult = [
                'type' => null,
                'status' => 'wrong_type',
                'found' => false,
                'expected' => 'IMS',
                'actual' => 'MJS',
                'nama_pos' => $mjs->nama_pos
            ];

            // Show error notification untuk wrong type dengan rate limiting
            $cacheKey = 'wrong_type_notification_' . Auth::id() . '_' . md5($cleanToken);
            if (!cache()->has($cacheKey)) {
                Notification::make()
                    ->title('Jenis QR tidak sesuai!')
                    ->body("Silakan pilih jenis QR yang benar.")
                    ->danger()
                    ->send();
                
                // Cache for 30 seconds to prevent spam
                cache()->put($cacheKey, true, 30);
            }

            // Send wrong type response to JavaScript
            $this->dispatch('scan-wrong-type', 'QR Code IMS diperlukan, tapi ini QR MJS');

            // Reset form
            $this->qrToken = '';
            $this->data['qrToken'] = '';
            return;
        }

        // Cari di tabel IMS (yang benar) - HANYA ROLE PENJAGA!
        $ims = Ims::where('qr_token', $cleanToken)
                  ->where('role_type', 'penjaga')  // SECURITY: Hanya QR penjaga!
                  ->first();
        if ($ims) {
            // Validasi nomor urut
            $lastScan = Scan::where('user_id', Auth::id())
                ->where('scanned_type', 'ims')
                ->where('status', 'valid')
                ->orderBy('created_at', 'desc')
                ->first();

            // Cek total nomor urut maksimum di IMS
            $maxNomorUrut = Ims::max('nomor_urut');

            $expectedNomorUrut = 1; // Default mulai dari 1
            if ($lastScan) {
                // Jika sudah scan sampai nomor urut terakhir, reset ke 1
                if ($lastScan->nomor_urut >= $maxNomorUrut) {
                    $expectedNomorUrut = 1;
                } else {
                    $expectedNomorUrut = $lastScan->nomor_urut + 1;
                }
            }

            // Cek apakah nomor urut sesuai
            if ($ims->nomor_urut != $expectedNomorUrut) {
                $this->scanResult = [
                    'type' => null,
                    'status' => 'wrong_sequence',
                    'found' => false,
                    'expected_urut' => $expectedNomorUrut,
                    'actual_urut' => $ims->nomor_urut,
                    'nama_pos' => $ims->nama_pos
                ];

                // Show error notification untuk nomor urut salah
                Notification::make()
                    ->title('Pos tidak sesuai!')
                    ->body('Anda harus scan sesuai dengan urutan pos.')
                    ->danger()
                    ->send();

                // Reset form
                $this->qrToken = '';
                $this->data['qrToken'] = '';
                return;
            }

            // Save scan record to database
            $scanRecord = Scan::create([
                'qr_token' => $cleanToken,
                'scanned_type' => 'ims',
                'scanned_id' => $ims->id,
                'nama_pos' => $ims->nama_pos,
                'nomor_urut' => $ims->nomor_urut,
                'status' => 'valid',
                'keterangan' => $this->data['keterangan'] ?? null,
                'user_id' => Auth::id()
            ]);

            $this->scanResult = [
                'type' => 'ims',
                'id' => $ims->id,
                'nama_pos' => $ims->nama_pos,
                'nomor_urut' => $ims->nomor_urut,
                'status' => 'valid',
                'created_at' => $ims->created_at,
                'updated_at' => $ims->updated_at,
                'found' => true
            ];

            // Show success notification
            Notification::make()
                ->title('QR Code berhasil di-scan!')
                ->body("Data IMS {$ims->nama_pos} berhasil disimpan ke rekapan")
                ->success()
                ->send();

            // Reset form after successful scan
            $this->qrToken = '';
            $this->data['qrToken'] = '';

            return;
        }

        // QR tidak ditemukan di kedua tabel
        $this->scanResult = [
            'type' => null,
            'status' => 'invalid',
            'found' => false
        ];

        // Show error notification
        Notification::make()
            ->title('QR Code tidak valid!')
            ->body('QR token IMS tidak ditemukan dalam sistem')
            ->danger()
            ->send();

        // Reset form after scan attempt
        $this->qrToken = '';
        $this->data['qrToken'] = '';
    }

    private function scanMjs($cleanToken)
    {
        // Cek apakah QR ini adalah QR IMS (salah pilih)
        $ims = Ims::where('qr_token', $cleanToken)->first();
        if ($ims) {
            $this->scanResult = [
                'type' => null,
                'status' => 'wrong_type',
                'found' => false,
                'expected' => 'MJS',
                'actual' => 'IMS',
                'nama_pos' => $ims->nama_pos
            ];

            // Show error notification untuk wrong type dengan rate limiting
            $cacheKey = 'wrong_type_notification_' . Auth::id() . '_' . md5($cleanToken);
            if (!cache()->has($cacheKey)) {
                Notification::make()
                    ->title('Jenis QR tidak sesuai!')
                    ->body("Silakan pilih jenis QR yang benar.")
                    ->danger()
                    ->send();
                
                // Cache for 30 seconds to prevent spam
                cache()->put($cacheKey, true, 30);
            }

            // Send wrong type response to JavaScript
            $this->dispatch('scan-wrong-type', 'QR Code MJS diperlukan, tapi ini QR IMS');

            // Reset form
            $this->qrToken = '';
            $this->data['qrToken'] = '';
            return;
        }

        // Cari di tabel MJS (yang benar) - HANYA ROLE PENJAGA!
        $mjs = Mjs::where('qr_token', $cleanToken)
                  ->where('role_type', 'penjaga')  // SECURITY: Hanya QR penjaga!
                  ->first();
        if ($mjs) {
            // Validasi nomor urut
            $lastScan = Scan::where('user_id', Auth::id())
                ->where('scanned_type', 'mjs')
                ->where('status', 'valid')
                ->orderBy('created_at', 'desc')
                ->first();

            // Cek total nomor urut maksimum di MJS
            $maxNomorUrut = Mjs::max('nomor_urut');

            $expectedNomorUrut = 1; // Default mulai dari 1
            if ($lastScan) {
                // Jika sudah scan sampai nomor urut terakhir, reset ke 1
                if ($lastScan->nomor_urut >= $maxNomorUrut) {
                    $expectedNomorUrut = 1;
                } else {
                    $expectedNomorUrut = $lastScan->nomor_urut + 1;
                }
            }

            // Cek apakah nomor urut sesuai
            if ($mjs->nomor_urut != $expectedNomorUrut) {
                $this->scanResult = [
                    'type' => null,
                    'status' => 'wrong_sequence',
                    'found' => false,
                    'expected_urut' => $expectedNomorUrut,
                    'actual_urut' => $mjs->nomor_urut,
                    'nama_pos' => $mjs->nama_pos
                ];

                // Show error notification untuk nomor urut salah
                Notification::make()
                    ->title('Pos tidak sesuai!')
                    ->body('Anda harus scan sesuai dengan urutan pos.')
                    ->danger()
                    ->send();

                // Reset form
                $this->qrToken = '';
                $this->data['qrToken'] = '';
                return;
            }

            // Save scan record to database
            $scanRecord = Scan::create([
                'qr_token' => $cleanToken,
                'scanned_type' => 'mjs',
                'scanned_id' => $mjs->id,
                'nama_pos' => $mjs->nama_pos,
                'nomor_urut' => $mjs->nomor_urut,
                'status' => 'valid',
                'keterangan' => $this->data['keterangan'] ?? null,
                'user_id' => Auth::id()
            ]);

            $this->scanResult = [
                'type' => 'mjs',
                'id' => $mjs->id,
                'nama_pos' => $mjs->nama_pos,
                'nomor_urut' => $mjs->nomor_urut,
                'status' => 'valid',
                'created_at' => $mjs->created_at,
                'updated_at' => $mjs->updated_at,
                'found' => true
            ];

            // Show success notification
            Notification::make()
                ->title('QR Code berhasil di-scan!')
                ->body("Data MJS {$mjs->nama_pos} nomor urut {$mjs->nomor_urut} berhasil disimpan ke rekapan")
                ->success()
                ->send();

            // Reset form after successful scan
            $this->qrToken = '';
            $this->data['qrToken'] = '';

            return;
        }

        // QR tidak ditemukan di kedua tabel
        $this->scanResult = [
            'type' => null,
            'status' => 'invalid',
            'found' => false
        ];

        // Show error notification
        Notification::make()
            ->title('QR Code tidak valid!')
            ->body('QR token MJS tidak ditemukan dalam sistem')
            ->danger()
            ->send();

        // Reset form after scan attempt
        $this->qrToken = '';
        $this->data['qrToken'] = '';
    }

    /**
     * Extract clean token from QR data
     */
    private function extractTokenFromQrData($qrData)
    {
        // If it's already a clean UUID, return as is
        if (preg_match('/^[a-f0-9]{8}-[a-f0-9]{4}-[a-f0-9]{4}-[a-f0-9]{4}-[a-f0-9]{12}$/i', $qrData)) {
            return $qrData;
        }

        // Try to extract UUID from the data
        if (preg_match('/([a-f0-9]{8}-[a-f0-9]{4}-[a-f0-9]{4}-[a-f0-9]{4}-[a-f0-9]{12})/i', $qrData, $matches)) {
            return $matches[1];
        }

        // Try to extract from "IMS Token: xxx" or "MJS Token: xxx" pattern
        if (preg_match('/(?:IMS|MJS|Token):\s*([a-f0-9-]+)/i', $qrData, $matches)) {
            return $matches[1];
        }

        // If no pattern matches, return the original data (might still work)
        return trim($qrData);
    }

    protected function getActions(): array
    {
        return [];
    }

    public static function getNavigationLabel(): string
    {
        return 'Scan QR';
    }
}