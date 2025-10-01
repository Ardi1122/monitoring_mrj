<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Identitas extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nik',
        'nomor_telepon',
        'alamat',
        'tanggal_lahir',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
