<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Rekapan extends Model
{
    use SoftDeletes;
    
    protected $table = 'scans';
    
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

    protected $casts = [
        'created_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function ims(): BelongsTo
    {
        return $this->belongsTo(Ims::class, 'scanned_id');
    }

    public function mjs(): BelongsTo
    {
        return $this->belongsTo(Mjs::class, 'scanned_id');
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

    // Accessor untuk nama
    public function getNamaPenjagaAttribute()
    {
        return $this->user ? $this->user->name : 'N/A';
    }

    // Accessor untuk tanggal scan
    public function getTanggalScanAttribute()
    {
        return $this->created_at ? $this->created_at->format('d/m/Y') : 'N/A';
    }

    // Accessor untuk jam scan  
    public function getJamScanAttribute()
    {
        return $this->created_at ? $this->created_at->format('H:i:s') : 'N/A';
    }

    // Accessor untuk nama post yang diambil dari IMS atau MJS
    public function getNamaPostAttribute()
    {
        if ($this->scanned_type === 'ims' && $this->ims) {
            return $this->ims->nama_post;
        } elseif ($this->scanned_type === 'mjs' && $this->mjs) {
            return $this->mjs->nama_post;
        }
        return $this->nama_pos ?: 'Tidak Diketahui';
    }

    // Accessor untuk scanned type
    public function getScanTypeAttribute()
    {
        return $this->scanned_type ?: 'Unknown';
    }
}
