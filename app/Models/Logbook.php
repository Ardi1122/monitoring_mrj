<?php

// app/Models/LogbookCoaching.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Logbook extends Model
{
    use HasFactory;

    protected $fillable = [
        'pengelola_id',
        'ibu_hamil_id',
        'tanggal',
        'topik',
        'hasil_diskusi',
        'tindak_lanjut',
        'checklist_perilaku',
    ];

     protected $casts = [
        'checklist_perilaku' => 'array', // <== penting!
    ];

    public function pengelola()
    {
        return $this->belongsTo(User::class, 'pengelola_id')->where('role', 'pengelola');
    }

    public function ibuHamil()
    {
        return $this->belongsTo(User::class, 'ibu_hamil_id')->where('role', 'ibu_hamil');
    }
}

