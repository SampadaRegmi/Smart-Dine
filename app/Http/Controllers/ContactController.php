<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Feedback;


class ContactController extends Controller
{
    public function showForm()
    {
        return view('User.Contact'); // Assuming 'User.Contact' is the correct path to your Contact Us view
    }

    public function submitForm(Request $request)
    {
        // Handle form submission logic here
        // You can access form data using $request->input('fieldname')

        // Example:
        $name = $request->input('name');
        $email = $request->input('email');
        $feedback = $request->input('text');

        // Perform actions with the form data, like saving to a database
        $feedback = new Feedback();
        $feedback->name = $request->input('name');
        $feedback->email = $request->input('email');
        $feedback->comment = $request->input('text');
        
        // Save the feedback to the database
        $feedback->save();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Form submitted successfully!');
    }
}
