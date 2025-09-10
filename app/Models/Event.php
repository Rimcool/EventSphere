<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'category',
        'description',
        'date',
        'time',
        'location',
        'total_seats',
        'registration_deadline',
        'image_path',
        'tags',
        'featured',
        'registration_required'
    ];
}