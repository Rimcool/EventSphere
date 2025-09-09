<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Event;
use App\Models\User;

class EventRegistration extends Model
{
    use HasFactory;
    
    protected $fillable = ['event_id', 'student_id', 'registered_at', 'status'];
    
    protected $casts = [
        'registered_at' => 'datetime',
    ];
    
    public function event()
    {
        return $this->belongsTo(Event::class);
    }
    
    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }
}