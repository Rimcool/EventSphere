<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use  App\Models\Gallery;
use  App\Models\Event;

class GalleryController extends Controller
{
    public function create()
{
    $events = Event::pluck('title','id');
    return view('admin.galleries', compact('events'));
}

public function store(Request $r)
{
    $data = $r->validate([
        'event_id'=>'nullable|exists:events,id',
        'image'=>'required|image|max:4096',
        'caption'=>'nullable|string|max:255'
    ]);
    $path = $r->file('image')->store('gallery','public');

    Gallery::create([
        'user_id' => $data['user_id'] ?? null,
        'image_path' => $path,
        'caption' => $data['caption'] ?? null,
        'uploaded_by' => auth()->id(),
    ]);

    return redirect()->route('admin.galleries')->with('success','Image uploaded.');
}

}
