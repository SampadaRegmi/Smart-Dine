<?php

namespace App\Http\Controllers;
use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function dashboard()
    {
        $admin = Auth::User(); // Retrieve the authenticated admin user
        return view('Admin.Pages.Dashboard', compact('admin'));
    }

        public function sidebarData()
    {
        $admin = Auth::user(); // Retrieve the authenticated admin user

        return view('Admin.Layouts.Sidebar', compact('admin'));
    }

    public function adminLogout()
    {
        Auth::logout(); // Logout the admin
        return redirect()->route('login'); // Redirect to the standard login route
    }

    public function showFeedback()
    {
         $admin = Auth::user();
         $feedbacks = Feedback::all();

         return view('Admin.Pages.admin.feedback', compact('feedbacks'));
    }

    // hsbjhbd


}




