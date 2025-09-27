<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PregnancyLog extends Model
{
     use HasFactory;

    protected $fillable = [
        'ibu_hamil_id',
        'tanggal',
        'symptoms',
        'mood',
        'appetite',
        'notes',
    ];

    protected $casts = [
        'symptoms' => 'array', // supaya JSON bisa otomatis diubah ke array
        'tanggal' => 'date',
    ];

    public function ibuHamil()
    {
        return $this->belongsTo(User::class, 'ibu_hamil_id');
    }
}
