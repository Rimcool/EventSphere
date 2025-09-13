<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'event_id',
        'rating',
        'comments'
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}