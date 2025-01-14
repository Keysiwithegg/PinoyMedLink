<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Hospital;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AdminAppointmentController extends Controller
{
    // Display the appointment index view
    public function index()
    {
        return view('admin.appointment.index');
    }

    // Store a new appointment
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'patient_id' => 'required|exists:patients,patient_id',
            'doctor_id' => 'required|exists:doctors,doctor_id',
            'appointment_date' => 'required|date',
            'reason_for_visit' => 'required|string|max:255',
            'status' => 'required|string|in:scheduled,cancelled,completed',
        ]);

        try {
            // Get the first hospital record
            $hospital = Hospital::first();
            if ($hospital) {
                // Add hospital_id to the validated data
                $validatedData['hospital_id'] = $hospital->hospital_id;
                // Create a new appointment with the validated data
                $appointment = Appointment::create($validatedData);
                return response()->json(['data' => $appointment, 'message' => 'Appointment created successfully.'], 201);
            } else {
                return response()->json(['message' => 'No hospital found.'], 404);
            }
        } catch (\Exception $e) {
            // Log the error and return a 500 response
            Log::error('Error creating appointment: ' . $e->getMessage());
            return response()->json(['message' => 'An error occurred while creating the appointment.'], 500);
        }
    }

    // Update an existing appointment
    public function update(Request $request, $id)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'patient_id' => 'required|exists:patients,patient_id',
            'doctor_id' => 'required|exists:doctors,doctor_id',
            'appointment_date' => 'required|date',
            'reason_for_visit' => 'required|string|max:255',
            'status' => 'required|string|in:scheduled,cancelled,completed',
        ]);

        try {
            // Get the first hospital record
            $hospital = Hospital::first();
            if ($hospital) {
                // Add hospital_id to the validated data
                $validatedData['hospital_id'] = $hospital->hospital_id;
                // Find the appointment by ID and update it with the validated data
                $appointment = Appointment::findOrFail($id);
                $appointment->update($validatedData);
                return response()->json(['data' => $appointment, 'message' => 'Appointment updated successfully.'], 200);
            } else {
                return response()->json(['message' => 'No hospital found.'], 404);
            }
        } catch (\Exception $e) {
            // Log the error and return a 500 response
            Log::error('Error updating appointment: ' . $e->getMessage());
            return response()->json(['message' => 'An error occurred while updating the appointment.'], 500);
        }
    }

    // Get the ID of the first hospital
    public function getHospitalId()
    {
        try {
            // Get the first hospital record
            $hospital = Hospital::first();
            if ($hospital) {
                return response()->json(['hospital_id' => $hospital->hospital_id], 200);
            } else {
                return response()->json(['message' => 'No hospital found.'], 404);
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
