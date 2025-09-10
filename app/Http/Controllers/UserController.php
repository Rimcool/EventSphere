<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display the homepage with featured events.
     */
    public function index()
    {
        // Fetch the latest 5 events that are marked as featured
        $featuredEvents = Event::where('featured', true)->latest()->take(5)->get();
        
        // Pass the fetched events to the 'user.index' view
        return view('user.index', compact('featuredEvents'));
    }

    /**
     * Display the about page.
     */
    public function about()
    {
        return view('user.about');
    }

    /**
     * Display all public events.
     */
    public function events()
    {
        $events = Event::all();
        return view('user.event', compact('events'));
    }

    /**
     * Display the features page.
     */
    public function features()
    {
        return view('user.features');
    }

    /**
     * Display the team page.
     */
    public function team()
    {
        return view('user.team');
    }

    /**
     * Display the testimonial page.
     */
    public function testimonial()
    {
        return view('user.testimonial');
    }

    /**
     * Display the contact page.
     */
    public function contact()
    {
        return view('user.contact');
    }
    
    /**
     * Display the event detail page for a specific event.
     */
    public function eventDetail(Event $event)
    {
        return view('user.event-detail', compact('event'));
    }

    /**
     * Handle the event booking request.
     */
    public function bookEvent(Event $event)
    {
        // For now, this just redirects to the previous page.
        // You can add the actual booking logic here.
        return redirect()->back()->with('success', 'Thank you for booking!');
    }
}
