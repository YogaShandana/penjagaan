<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Str;

class Ims extends Model
{
    protected $fillable = [
        'nama_post',
        'nomor_urut',
        'role_type',
        'qr_token',
        'qr_code',
    ];

    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($ims) {
            // Generate unique token for QR
            $ims->qr_token = Str::uuid();
            // Generate QR code with token
            $ims->qr_code = $ims->generateQrCode();
        });
    }

    public function generateQrCode()
    {
        $data = "IMS Token: {$this->qr_token}\nNama Post: {$this->nama_post}\nNomor Urut: {$this->nomor_urut}\nRole: {$this->role_type}";
        return base64_encode(QrCode::format('svg')->size(200)->generate($data));
    }

    public function regenerateQrCode()
    {
        // Generate new token (make old QR invalid)
        $this->qr_token = Str::uuid();
        $this->qr_code = $this->generateQrCode();
        $this->save();
        
        return $this;
    }
}
