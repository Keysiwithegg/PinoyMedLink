<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\Appointment;
use App\Models\Hospital;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class PatientAppointmentController extends Controller
{
    // Ensure only authenticated patients can access
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('patient.access');
    }

    // Display the patient's appointments view
    public function index()
    {
        $user = auth()->user();

        // Check if the user has an associated patient record
        if (!$user->patient) {
            return redirect()->route('home')->with('error', 'No associated patient record found.');
        }

        $patientId = $user->patient->patient_id;

        // Fetch all appointments for the patient
        $appointments = Appointment::where('patient_id', $patientId)->get();

        return view('patient.index', compact('appointments'));
    }

    // Store a new appointment
    public function store(Request $request)
    {
        $user = Auth::user();

        // Log the authenticated user
        Log::info('Authenticated user:', ['user' => $user]);

        // Check if the user has an associated patient record
        if (!$user->patient) {
            Log::error('No associated patient record found for user:', ['user_id' => $user->id]);
            return response()->json(['error' => 'No associated patient record found.'], 400);
        }

        $patientId = $user->patient->patient_id;

        // Validate the request data
        $validatedData = $request->validate([
            'doctor_id' => 'required|exists:doctors,doctor_id',
            'appointment_date' => 'required|date',
            'reason_for_visit' => 'required|string|max:255',
            'status' => 'required|in:scheduled,cancelled,completed',
        ]);

        // Log the validated data
        Log::info('Validated appointment data:', $validatedData);

        // Find the first hospital
        $hospital = Hospital::first();

        // Log the hospital data
        Log::info('Selected hospital:', ['hospital' => $hospital]);

        // Create a new appointment
        $appointment = Appointment::create([
            'patient_id' => $patientId,
            'doctor_id' => $request->doctor_id,
            'hospital_id' => $hospital->hospital_id,
            'appointment_date' => $request->appointment_date,
            'reason_for_visit' => $request->reason_for_visit,
            'status' => $request->status,
        ]);

        // Log the created appointment
        Log::info('Created appointment:', ['appointment' => $appointment]);

        return response()->json(['success' => 'Appointment created successfully.', 'appointment' => $appointment], 201);
    }
}
