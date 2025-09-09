<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use App\Models\EventCategory;
use App\Models\EventRegistration;
use App\Models\Gallery;

class EventController extends Controller
{
    
public function index()
{
    $categories = EventCategory::all();
    return view('admin.event_categories.index', compact('categories'));
}

public function create()
{
    return view('admin.event_categories.create');
}

public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
    ]);
    
    EventCategory::create($request->all());
    
    return redirect()->route('admin.event-categories.index')
        ->with('success', 'Category created successfully.');
}

public function edit(EventCategory $eventCategory)
{
    return view('admin.event_categories.edit', compact('eventCategory'));
}

public function update(Request $request, EventCategory $eventCategory)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
    ]);
    
    $eventCategory->update($request->all());
    
    return redirect()->route('admin.event-categories.index')
        ->with('success', 'Category updated successfully.');
}

public function destroy(EventCategory $eventCategory)
{
    $eventCategory->delete();
    
    return redirect()->route('admin.event-categories.index')
        ->with('success', 'Category deleted successfully.');
}
}
