<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // to use bootstrap pagination
        Paginator::useBootstrap();
        // grap user with latest user and paginate 20 users
        $users = User::latest()->paginate(20);
        // retur view user index
        return view('Admin.Pages.User.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Admin.Pages.User.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['nullable', 'numeric'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role' => [
                'required',
                Rule::in(User::USER_ROLE), // Validate against the enum values
            ],
        ]);
        // set all data from request to the variable $data
        $data = $request->all();
        $data['password'] = Hash::make($data['password']);

        // create data to the table
        User::create($data);

        return redirect(route('user.index'))->with('success', 'User Created Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //  
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('Admin.Pages.User.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,id,' . $user->id],
            'phone' => ['nullable', 'numeric'],
            'password' => ['nullable', 'string', 'min:8'],
        ]);
        // set all data from request to the variable $data
        $data = $request->all();

        // check password is null or not
        if ($data['password'] == null) {
            $data['password'] = $user->password;
        } else {
            $data['password'] = Hash::make($data['password']);
        }

        // create data to the table
        $user->update($data);

        return redirect(route('user.index'))->with('success', 'User Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return back()->with('success', 'User Deleted Successfully!');
    }

    public function editProfile()
    {
        // Get the authenticated user
        $user = Auth::user();

        // Pass the user data to the view
        return view('User.Pages.profile.edit', compact('user'));
    }

    public function updateProfile(Request $request, $id)
    {
        $user = Auth::user();
    
        // Validate the form data
        $request->validate([
            'name' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255|unique:users,email,' . $id,
            'phone' => 'nullable|string|max:20',
            'new_password' => 'nullable|string|min:8|confirmed',
        ]);
    
        // Update password only if new password is provided
        if ($request->filled('new_password')) {
            $request->validate([
                'new_password' => 'required|string|min:8|confirmed',
            ]);
    
            $user->password = bcrypt($request->new_password);
        }
    
        // Update other fields
        $user->name = $request->input('name', $user->name);
        $user->email = $request->input('email', $user->email);
        $user->phone = $request->input('phone', $user->phone);
    
        // Save changes
        $user->save();
    
        // Set success message
        return redirect()->back()->with('success', 'Profile updated successfully');
    }

    // UserController.php

    public function submitFeedback(Request $request)
    {
        // Validate the form data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'text' => 'required|string',
        ]);

        // Save the feedback to the database
        Feedback::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'text' => $request->input('text'),
        ]);

        return redirect()->back()->with('success', 'Feedback submitted successfully!');
    }
}
