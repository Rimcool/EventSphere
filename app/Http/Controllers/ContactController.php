<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Show the public contact form.
     */
    public function create()
    {
        return view('user.contact');
    }

    /**
     * Store a new contact submission.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        Contact::create($validatedData);

        // Redirect back to the contact form with a success message
        return redirect()->route('contact.create')
                         ->with('success', 'Contact message sent successfully!');
    }

    /**
     * Display a paginated list of contact submissions (admin).
     */
    public function index()
    {
        $contacts = Contact::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.contacts', compact('contacts'));
    }

    /**
     * Show a single contact submission (admin).
     */
    public function show(Contact $contact)
    {
        return response()->json($contact);
    }

    /**
     * Delete a contact submission (admin).
     */
    public function destroy(Contact $contact)
    {
        $contact->delete();
        return redirect()->route('admin.contacts.index')
            ->with('success', 'Contact deleted successfully.');
    }

    // Add your PDF export method here if needed
}