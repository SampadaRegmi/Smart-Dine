<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\TestEmail;

class MailTestController extends Controller
{
    public function sendTestEmail()
    {
        try {
            // Get the currently authenticated user
            $user = Auth::user();

            // Check if a user is authenticated
            if ($user) {
                // Use the email address of the authenticated user as the recipient's email
                $recipientEmail = $user->email;

                // Send the test email
                Mail::to($recipientEmail)->send(new TestEmail());

                return "Test email sent successfully to $recipientEmail";
            } else {
                return "No authenticated user found.";
            }
        } catch (\Exception $e) {
            // Handle any exceptions that occur during email sending
            return "Failed to send test email: " . $e->getMessage();
        }
    }
}
