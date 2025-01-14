<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminProfileController extends Controller
{
    // Display the admin profile index view
    public function index()
    {
        return view('admin.profile.index');
    }

    // Update the admin profile
    public function update(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . auth()->id(),
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        // Get the authenticated user
        $user = auth()->user();
        // Update the user's name and email
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        // If a new password is provided, hash and update it
        if ($request->filled('password')) {
            $user->password = Hash::make($request->input('password'));
        }
        // Save the updated user data
        $user->save();

        // Redirect back to the profile index with a success message
        return redirect()->route('admin.profile.index')->with('success', 'Profile updated successfully.');
    }
}
