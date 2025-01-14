<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Doctor;
use Illuminate\Support\Facades\Auth;

class DoctorProfileController extends Controller
{
    // Display the doctor's profile view
    public function index()
    {
        $user = Auth::user();
        $doctor = $user->doctor;

        return view('doctor.profile.index', compact('user', 'doctor'));
    }

    // Update the doctor's profile
    public function update(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'email' => 'required|string|email|max:255|unique:users,email,' . Auth::id(),
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'specialty' => 'required|string|max:255',
            'contact_number' => 'required|string|max:15',
        ]);

        // Update the user's information
        $user = Auth::user();
        $fullName = $request->first_name . ' ' . $request->last_name;
        $user->update([
            'name' => $fullName,
            'email' => $request->email,
        ]);

        // Update the doctor's information
        $doctor = $user->doctor;
        $doctor->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'specialty' => $request->specialty,
            'contact_number' => $request->contact_number,
        ]);

        return redirect()->route('profile.doctor.index')->with('success', 'Profile updated successfully.');
    }
}
