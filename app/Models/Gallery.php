<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Event;

// app/Models/Gallery.php
class Gallery extends Model
{
    use HasFactory;
    
    protected $fillable = ['event_id', 'title', 'description', 'image_path', 'is_active'];
    
    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}