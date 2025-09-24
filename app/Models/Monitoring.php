<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Monitoring extends Model
{
    use HasFactory;

    protected $fillable = [
        'pengelola_id',
        'ibu_hamil_id',
        'tanggal',
        'usia_kehamilan',
        'lila',
        'berat_badan',
        'tinggi_badan',
        'tekanan_darah_sistolik',
        'tekanan_darah_diastolik',
        'nadi',
        'respirasi',
        'paritas',
        'hb',
        'konsumsi_mrj',
        'konsumsi_jely',
    ];


    public function pengelola()
    {
        return $this->belongsTo(User::class, 'pengelola_id');
    }

    public function ibuHamil()
    {
        return $this->belongsTo(User::class, 'ibu_hamil_id');
    }
}
