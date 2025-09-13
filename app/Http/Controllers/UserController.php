<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Booking;
use App\Models\Feedback;
use Illuminate\Http\Request;
use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Writer\PngWriter;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Mail\FeedbackConfirmation;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    /**
     * Through this code all things rellated to user like showing page pages & booking & email & all are happening because of this controller.
     */
    public function index()
    {
        
        $featuredEvents = Event::where('featured', true)->latest()->take(5)->get();
        
        
        $events = Event::where('date', '>=', now())->get();
        
        
        return view('user.index', compact('featuredEvents', 'events'));
    }

   
    public function about()
    {
        return view('user.about');
    }

    
    public function events()
    {
        $events = Event::all();
        return view('user.event', compact('events'));
    }

    
    public function features()
    {
        return view('user.features');
    }

    
    public function team()
    {
        return view('user.team');
    }

    
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
    
   
    public function eventDetail(Event $event)
    {
        return view('user.event-detail', compact('event'));
    }

   
    public function bookEvent(Event $event)
    {
        
        return redirect()->back()->with('success', 'Thank you for booking!');
    }

   
    public function manageFeedback()
    {
        $feedbacks = Feedback::with('event')->latest()->get();
        return view('admin.feedback', compact('feedbacks'));
    }

    
    public function viewFeedback(Feedback $feedback)
    {
        return view('admin.feedback-view', compact('feedback'));
    }

    
    public function deleteFeedback(Feedback $feedback)
    {
        $feedback->delete();
        return redirect()->route('admin.feedback')->with('success', 'Feedback deleted successfully.');
    }

    
public function storeFeedback(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'event_id' => 'required|exists:events,id',
            'rating' => 'required|integer|between:1,5',
            'comments' => 'required|string'
        ]);

        $feedback = Feedback::create($request->all());

       
        try {
            Mail::to($feedback->email)->send(new FeedbackConfirmation($feedback));
        } catch (\Exception $e) {
            \Log::error('Failed to send confirmation email: ' . $e->getMessage());
        }

    
        return redirect()->back()->with('success', 'Thank you for your feedback! A confirmation email has been sent to your email address.');
    }
}


