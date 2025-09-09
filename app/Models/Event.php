<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\EventCategory;
use App\Models\EventRegistration;
use App\Models\Gallery;

// app/Models/Event.php
class Event extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'category_id', 'title', 'description', 'event_date', 
        'location', 'total_seats', 'available_seats', 'image', 'is_active'
    ];
    
    protected $dates = ['event_date'];
    
    public function category()
    {
        return $this->belongsTo(EventCategory::class);
    }
    
    public function registrations()
    {
        return $this->hasMany(EventRegistration::class);
    }
    
    public function gallery()
    {
        return $this->hasMany(Gallery::class);
    }
}
