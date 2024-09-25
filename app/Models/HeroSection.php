<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HeroSection extends Model
{
    use HasFactory;

    protected $fillable = [
        'heading',
        'subheading',
        'button_text',
        'button_link',
        'image',
        'bg_color',
    ];

    protected $casts = [
        'bg_color' => 'string',
    ];
}