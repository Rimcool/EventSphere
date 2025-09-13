<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use App\Models\Event;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class FeedbackController extends Controller
{
    public function create()
    {
        $events = Event::where('date', '>=', now())->get();
        return view('feedback.create', compact('events'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'event_id' => 'required|exists:events,id',
            'rating' => 'required|integer|between:1,5',
            'comments' => 'required|string'
        ]);

        Feedback::create($request->all());

        return redirect()->back()->with('success', 'Thank you for your feedback! Your response has been recorded successfully.');
    }

    public function index()
    {
        $feedbacks = Feedback::with('event')->latest()->get();
        return view('admin.feedback.index', compact('feedbacks'));
    }

    public function exportPDF()
    {
        $feedbacks = Feedback::with('event')->latest()->get();
        
        $pdf = Pdf::loadView('admin.feedback.pdf', compact('feedbacks'));
        return $pdf->download('feedback-report-' . now()->format('Y-m-d') . '.pdf');
    }
}