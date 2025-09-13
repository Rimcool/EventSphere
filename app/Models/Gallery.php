<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $fillable = ['event_id','image_path','caption','uploaded_by'];

    public function event(){ return $this->belongsTo(Event::class); }
    public function uploader(){ return $this->belongsTo(User::class,'uploaded_by'); }
}

