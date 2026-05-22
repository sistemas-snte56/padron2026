<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Padron extends Model
{
    protected $table = 'padron';

    protected $fillable = [
        'region',
        'delegacion',
        'nivel',
        'sede',
        'padron',
    ];

    protected $casts = [
        'padron' => 'boolean',
    ];    
}
