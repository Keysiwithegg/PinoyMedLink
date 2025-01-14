<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Patient;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminPatientController extends Controller
{
    // Display the patient index view
    public function index()
    {
        return view('admin.patient.index');
    }

    // Return a JSON response with all patients
    public function dataTable()
    {
        $patients = Patient::all();
        return response()->json(['data' => $patients]);
    }

    // Store a new patient
    public function store(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
            'gender' => 'required|string|max:10',
            'contact_number' => 'required|string|max:15',
            'email' => 'required|email|max:255|unique:users,email',
            'address' => 'required|string|max:500',
        ]);

        // Create a new user
        $user = new User();
        $user->name = $request->first_name . ' ' . $request->last_name;
        $user->email = $request->email;
        $user->password = Hash::make('Test@123'); // Set a default password or generate one
        $user->role_id = 0; // Set role_id to 0 for patients
        $user->save();

        // Create a new patient
        $patient = new Patient();
        $patient->user_id = $user->id; // Associate the patient with the newly created user
        $patient->first_name = $request->first_name;
        $patient->last_name = $request->last_name;
        $patient->date_of_birth = $request->date_of_birth;
        $patient->gender = $request->gender;
        $patient->contact_number = $request->contact_number;
        $patient->email = $request->email;
        $patient->address = $request->address;
        $patient->doctor_id = Auth::id(); // Assuming the authenticated user is the doctor
        $patient->save();

        return response()->json(['message' => 'Patient record has been added successfully.']);
    }
}
