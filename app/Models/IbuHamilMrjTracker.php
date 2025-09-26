<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class IbuHamilMrjTracker extends Model
{
     use HasFactory;

    protected $fillable = [
        'ibu_hamil_id',
        'mrj_tracker_id',
        'tanggal',
        'target_harian',
        'konsumsi_harian',
        'stok_sisa',
    ];

    // Relasi ke ibu hamil
    public function ibuHamil()
    {
        return $this->belongsTo(User::class, 'ibu_hamil_id');
    }

    // Relasi ke stok kader
    public function stokKader()
    {
        return $this->belongsTo(MrjTracker::class, 'mrj_tracker_id');
    }
}
