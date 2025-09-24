<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Reminder extends Model
{
    use HasFactory;

    protected $fillable = [
        'ibu_hamil_id',
        'created_by',
        'judul',
        'deskripsi',
        'tanggal',
        'status',
    ];

    public function ibuHamil()
    {
        return $this->belongsTo(User::class, 'ibu_hamil_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
