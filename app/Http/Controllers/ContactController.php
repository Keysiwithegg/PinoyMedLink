<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\ContactFormMail;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    // Display the contact form view
    public function index()
    {
        return view('contact');
    }

    // Handle the form submission
    public function submit(Request $request)
    {
        // Validate the incoming request data
        $details = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string',
        ]);

        // Send the contact form email
        Mail::to(env('MAIL_FROM_ADDRESS'))->send(new ContactFormMail($details));

        // Redirect back with a success message
        return back()->with('success', 'Your message has been sent successfully!');
    }
}
