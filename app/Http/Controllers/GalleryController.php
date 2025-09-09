<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class GalleryController extends Controller
{
    
public function index()
{
    $images = Gallery::with('event')->get();
    return view('admin.gallery.index', compact('images'));
}

public function create()
{
    $events = Event::all();
    return view('admin.gallery.create', compact('events'));
}

public function store(Request $request)
{
    $request->validate([
        'event_id' => 'nullable|exists:events,id',
        'title' => 'required|string|max:255',
        'description' => 'nullable|string',
        'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);
    
    $data = $request->all();
    
    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('gallery', 'public');
        $data['image_path'] = $imagePath;
    }
    
    Gallery::create($data);
    
    return redirect()->route('admin.gallery.index')
        ->with('success', 'Image uploaded successfully.');
}

public function destroy(Gallery $gallery)
{
    if ($gallery->image_path) {
        Storage::disk('public')->delete($gallery->image_path);
    }
    
    $gallery->delete();
    
    return redirect()->route('admin.gallery.index')
        ->with('success', 'Image deleted successfully.');
}
}
