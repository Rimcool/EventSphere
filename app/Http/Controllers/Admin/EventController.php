<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Mail\BookingConfirmationMail;
use Illuminate\Support\Facades\Mail;
use App\Models\Booking; 

class EventController extends Controller
{
    /**
     * Display a listing of events for the admin panel.
     */
    public function index()
    {
        $events = Event::latest()->get();
        return view('admin.forms', compact('events'));
    }

    /**
     * Show the form for creating a new event.
     */
    public function create()
    {
        return view('admin.events.create');
    }

    /**
     * Store a newly created event in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'category' => 'required',
            'description' => 'required',
            'date' => 'required|date',
            'time' => 'required',
            'location' => 'required',
            'total_seats' => 'required|integer|min:0',
            'registration_deadline' => 'nullable|date',
            'event_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'tags' => 'nullable',
            'featured' => 'boolean',
            'registration_required' => 'boolean'
        ]);

        // Handle image upload and save the path to the 'image' field for consistency
        if ($request->hasFile('event_image')) {
            $imagePath = $request->file('event_image')->store('events', 'public');
            $validated['image'] = $imagePath;
        }

        // Convert tags array to string if needed
        if (isset($validated['tags']) && is_array($validated['tags'])) {
            $validated['tags'] = implode(',', $validated['tags']);
        }

        Event::create($validated);

        return redirect()->route('admin.form')
                        ->with('success', 'Event created successfully.');
    }

    /**
     * Display the specified event.
     */
    public function show(Event $event)
    {
        return view('admin.events.show', compact('event'));
    }

    /**
     * Show the form for editing the specified event.
     */
    public function edit(Event $event)
    {
        return view('admin.events.edit', compact('event'));
    }

    /**
     * Update the specified event in storage.
     */
    public function update(Request $request, Event $event)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'category' => 'required',
            'description' => 'required',
            'date' => 'required|date',
            'time' => 'required',
            'location' => 'required',
            'total_seats' => 'required|integer|min:0',
            'registration_deadline' => 'nullable|date',
            'event_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'tags' => 'nullable',
            'featured' => 'boolean',
            'registration_required' => 'boolean'
        ]);

        // Handle new image upload and delete old image if it exists
        if ($request->hasFile('event_image')) {
            if ($event->image) {
                Storage::disk('public')->delete($event->image);
            }
            $imagePath = $request->file('event_image')->store('events', 'public');
            $validated['image'] = $imagePath;
        }

        if (isset($validated['tags']) && is_array($validated['tags'])) {
            $validated['tags'] = implode(',', $validated['tags']);
        }

        $event->update($validated);

        return redirect()->route('admin.form')
                        ->with('success', 'Event updated successfully.');
    }

    /**
     * Remove the specified event from storage.
     */
    public function destroy(Event $event)
    {
        // Delete associated image if exists, using the correct 'image' field
        if ($event->image) {
            Storage::disk('public')->delete($event->image);
        }
        
        $event->delete();
        
        return redirect()->route('admin.form')
                        ->with('success', 'Event deleted successfully.');
    }

    /**
     * Display featured events on the homepage.
     */
    public function showHomepageEvents()
    {
        $featuredEvents = Event::where('featured', 1)->latest()->take(5)->get();
        // The view expects a variable named 'featuredEvents'
        return view('user.index', compact('featuredEvents'));
    }

    /**
     * Display all events on the public events page.
     */
    public function showPublicEvents()
    {
        $events = Event::latest()->get();
        // The events page view expects a variable named 'events'
        return view('user.event', compact('events'));
    }
    
    /**
     * Handle event booking.
     */
        /**
     * Handle event booking with email confirmation.
     */
    public function bookEvent($id)
    {
        $event = Event::findOrFail($id);

        if ($event->booked_seats < $event->total_seats) {
            $event->booked_seats += 1;
            $event->save();

            // Optional: create a Booking record linked to user & event
            $booking = Booking::create([
                'user_id' => auth()->id(),
                'event_id' => $event->id,
                'seat_number' => $event->booked_seats,
            ]);

            // Send confirmation email to user
            Mail::to(auth()->user()->email)->send(new BookingConfirmationMail($booking));

            return redirect()->back()->with('success', 'Seat booked! A confirmation email with your ticket has been sent.');
        } else {
            return redirect()->back()->with('error', 'No seats available.');
        }
    }


    /**
     * Display a single event's details.
     */
    public function showEventDetail($id)
    {
        $event = Event::findOrFail($id);
        return view('user.event_detail', compact('event'));
    }
}
