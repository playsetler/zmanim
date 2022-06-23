<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'type',
        'path',
        'url'
    ];

    protected $casts = [
        'created_at' => 'datetime:d.m.Y - H:i:s',
        'updated_at' => 'datetime:d.m.Y - H:i:s',
    ];
}
