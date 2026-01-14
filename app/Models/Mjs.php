<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Str;

class Mjs extends Model
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
        
        static::creating(function ($mjs) {
            // Generate unique token for QR only if not already set
            if (empty($mjs->qr_token)) {
                $mjs->qr_token = Str::uuid();
            }
            // Generate QR code with only the token (simple and scannable)
            $mjs->qr_code = base64_encode(QrCode::format('svg')->size(200)->generate($mjs->qr_token));
        });
    }

    public function generateQrCode()
    {
        // Generate QR code with only the token
        return base64_encode(QrCode::format('svg')->size(200)->generate($this->qr_token));
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
