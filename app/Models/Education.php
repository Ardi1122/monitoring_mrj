<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Education extends Model
{
    use HasFactory;

    protected $fillable = [
        'thumbnail_url',
        'title',
        'slug',
        'type',
        'content_url',
        'description',
        'views',
        'is_popular',
    ];
}
