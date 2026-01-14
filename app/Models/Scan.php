<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Scan extends Model
{
    protected $fillable = [
        'qr_token',
        'scanned_type',
        'scanned_id',
        'nama_pos',
        'nomor_urut',
        'status',
        'keterangan',
        'user_id'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    
    public function getScannedItem()
    {
        if ($this->scanned_type === 'ims') {
            return Ims::find($this->scanned_id);
        } elseif ($this->scanned_type === 'mjs') {
            return Mjs::find($this->scanned_id);
        }
        return null;
    }
}
