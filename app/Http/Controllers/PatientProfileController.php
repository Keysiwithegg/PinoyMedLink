<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Patient;
use Illuminate\Support\Facades\Auth;

class PatientProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $patient = $user->patient;

        return view('patient.profile.index', compact('user', 'patient'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email|max:255|unique:users,email,' . Auth::id(),
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'contact_number' => 'required|string|max:15',
            'address' => 'required|string|max:255',
        ]);

        $user = Auth::user();
        $fullName = $request->first_name . ' ' . $request->last_name;
        $user->update([
            'name' => $fullName,
            'email' => $request->email,
        ]);

        $patient = $user->patient;
        $patient->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'contact_number' => $request->contact_number,
            'address' => $request->address,
        ]);

        return redirect()->route('profile.patient.index')->with('success', 'Profile updated successfully.');
    }
}
