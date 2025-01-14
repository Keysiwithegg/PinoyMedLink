<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class DoctorAppointmentController extends Controller
{
    // Display the doctor appointment index view
    public function index()
    {
        return view('doctor.appointment.index');
    }

    // Store a new appointment
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'patient_id' => 'required|exists:patients,patient_id',
            'doctor_id' => 'required|exists:doctors,doctor_id',
            'hospital_id' => 'required|exists:hospitals,hospital_id',
            'appointment_date' => 'required|date',
            'reason_for_visit' => 'required|string|max:255',
            'status' => 'required|string|in:scheduled,cancelled,completed',
        ]);

        try {
            // Create a new appointment with the validated data
            $appointment = Appointment::create($validatedData);
            return response()->json(['data' => $appointment, 'message' => 'Appointment created successfully.'], 201);
        } catch (\Exception $e) {
            // Log the error and return a 500 response
            Log::error('Error creating appointment: ' . $e->getMessage());
            return response()->json(['message' => 'An error occurred while creating the appointment.'], 500);
        }
    }

    // Update an existing appointment
    public function update(Request $request, $id)
    {
        // Log the incoming request data
        Log::info($request->all());

        // Validate the incoming request data
        $validatedData = $request->validate([
            'patient_id' => 'required|exists:patients,patient_id',
            'doctor_id' => 'required|exists:doctors,doctor_id',
            'hospital_id' => 'required|exists:hospitals,hospital_id',
            'appointment_date' => 'required|date',
            'reason_for_visit' => 'required|string|max:255',
            'status' => 'required|string|in:scheduled,cancelled,completed',
        ]);

        try {
            // Find the appointment by ID and update it with the validated data
            $appointment = Appointment::findOrFail($id);
            $appointment->update($validatedData);

            // Log the updated appointment data
            Log::info($appointment);
            return response()->json(['data' => $appointment, 'message' => 'Appointment updated successfully.'], 200);
        } catch (\Exception $e) {
            // Log the error and return a 500 response
            Log::error('Error updating appointment: ' . $e->getMessage());
            return response()->json(['message' => 'An error occurred while updating the appointment.'], 500);
        }
    }

    // Get the hospital ID for the authenticated doctor
    public function getHospitalId()
    {
        try {
            // Get the authenticated user
            $user = Auth::user();
            // Find the doctor by user ID
            $doctor = Doctor::where('user_id', $user->id)->first();

            if ($doctor) {
                return response()->json(['hospital_id' => $doctor->hospital_id], 200);
            } else {
                return response()->json(['message' => 'Doctor not found.'], 404);
            }
        } catch (\Exception $e) {
            // Log the error and return a 500 response
            Log::error('Error fetching hospital ID: ' . $e->getMessage());
            return response()->json(['message' => 'An error occurred while fetching the hospital ID.'], 500);
        }
    }

    // Get all appointments with related patient, doctor, and hospital data
    public function getAllAppointments()
    {
        try {
            // Retrieve all appointments with their related models
            $appointments = Appointment::with(['patient', 'doctor', 'hospital'])->get();
            return response()->json(['data' => $appointments], 200);
        } catch (\Exception $e) {
            // Log the error and return a 500 response
            Log::error('Error fetching appointments: ' . $e->getMessage());
            return response()->json(['message' => 'An error occurred while fetching the appointments.'], 500);
        }
    }

    // Fetch a specific appointment by ID with related patient, doctor, and hospital data
    public function fetch($id)
    {
        try {
            // Find the appointment by ID with its related models
            $appointment = Appointment::with(['patient', 'doctor', 'hospital'])->findOrFail($id);
            return response()->json(['data' => $appointment], 200);
        } catch (\Exception $e) {
            // Log the error and return a 500 response
            Log::error('Error fetching appointment: ' . $e->getMessage());
            return response()->json(['message' => 'An error occurred while fetching the appointment.'], 500);
        }
    }
}
