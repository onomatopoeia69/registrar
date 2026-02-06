<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $table = 'events';

     protected $fillable = [
        'title',
        'description',
        'background_color',
        'border_color',
        'text_color',
        'start',
        'end',
        'all_day'
    ];

    protected $casts = [
    'start' => 'datetime',
    'end'   => 'datetime',
    ];




}
