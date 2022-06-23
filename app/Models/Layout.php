<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Layout extends Model
{
    use HasFactory;
    //protected $quarded = false;
    protected $fillable = [
        'name',
        'orientation',
        'backgroundType',
        'backgroundColor',
        'backgroundImage',
        'backgroundSize',
        'media'
    ];

    protected $casts = [
        'media' => 'array',
        'created_at' => 'datetime:d.m.Y - H:i:s',
        'updated_at' => 'datetime:d.m.Y - H:i:s',
    ];
}
