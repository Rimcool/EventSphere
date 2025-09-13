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
     * Display a listing of the events.
     *
     * @return \Illuminate\View\View
     */


    /**
     * Show the form for creating a new event.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.events.create');
    }

    /**
     * Store a newly created event in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
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

        if ($request->hasFile('event_image')) {
            $imagePath = $request->file('event_image')->store('events', 'public');
            $validated['image'] = $imagePath;
        }

        if (isset($validated['tags']) && is_array($validated['tags'])) {
            $validated['tags'] = implode(',', $validated['tags']);
        }

        Event::create($validated);

        // Redirect to the events index page after creation.
        return redirect()->route('admin.events.index')
                         ->with('success', 'Event created successfully.');
    }

    /**
     * Display the specified event.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\View\View
     */
    public function show(Event $event)
    {
        return view('admin.events.show', compact('event'));
    }

    /**
     * Show the form for editing the specified event.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\View\View
     */
    public function edit(Event $event)
    {
        return view('admin.events.edit', compact('event'));
    }

    /**
     * Update the specified event in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\RedirectResponse
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

        // Redirect to the events index page after update.
        return redirect()->route('admin.events.index')
                         ->with('success', 'Event updated successfully.');
    }

    /**
     * Remove the specified event from storage.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Event $event)
    {
        // Delete associated image if exists, using the correct 'image' field
        if ($event->image) {
            Storage::disk('public')->delete($event->image);
        }

        $event->delete();

    
        return redirect()->route('admin.events.index')
                         ->with('success', 'Event deleted successfully.');
    }

    /**
     * Show featured events on the homepage.
     *
     * @return \Illuminate\View\View
     */
    public function showHomepageEvents()
    {
        
        $featuredEvents = Event::where('featured', 1)->latest()->take(5)->get();

        
        $events = Event::all();

        // Pass both variables to the view.
        return view('user.index', compact('featuredEvents', 'events'));
    }

    /**
     * Show a list of all public events.
     *
     * @return \Illuminate\View\View
     */
    public function showPublicEvents()
    {
        $events = Event::latest()->get();
        
        return view('user.event', compact('events'));
    }

    /**
     * Handle the event booking process.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function bookEvent(Request $request, $id)
    {
        $event = Event::findOrFail($id);

        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'seat_count' => 'required|integer|min:1|max:' . ($event->total_seats - $event->booked_seats),
        ]);

       
        $userId = auth()->check() ? auth()->id() : null;

        
        $booking = new Booking();
        $booking->user_id = $userId;
        $booking->event_id = $event->id;
        $booking->name = $request->name;
        $booking->email = $request->email;
        $booking->seat_count = $request->seat_count;
        $booking->ticket_number = 'EVT-' . now()->timestamp . rand(100, 999);
        $booking->seat_number = null;

        $booking->save();

       
        $event->booked_seats += $request->seat_count;
        $event->save();

        return response()->json([
            'success' => true,
            'message' => 'Booking successful!',
            'ticketNumber' => $booking->ticket_number,
            'bookingDate' => $booking->created_at->format('Y-m-d'),
            'name' => $booking->name,
            'email' => $booking->email,
            'seatCount' => $booking->seat_count,
            'seatsLeft' => $event->total_seats - $event->booked_seats,
        ]);
    }

    /**
     * Show event details for a public view.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function showEventDetail($id)
    {
        $event = Event::findOrFail($id);
        return view('user.event_detail', compact('event'));
    }

    public function index()
{
   
    $events = \App\Models\Event::orderBy('created_at', 'desc')->paginate(10);

    
    return view('admin.events.index', compact('events'));
}
 
}
