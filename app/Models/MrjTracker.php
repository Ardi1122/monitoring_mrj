<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MrjTracker extends Model
{
    use HasFactory;

    protected $fillable = [
        'kader_id',
        'tanggal',
        'jumlah_produksi',
        'jumlah_distribusi',
        'stok_sisa',
        'created_by',
    ];

    public function kader()
    {
        return $this->belongsTo(User::class, 'kader_id');
    }

    public function konsumsiIbuHamil()
    {
        return $this->hasMany(IbuHamilMrjTracker::class, 'mrj_tracker_id');
    }
}
