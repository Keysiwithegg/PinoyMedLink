<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class DoctorAppointmentController extends Controller
{
    public function index()
    {
        return view('doctor.appointment.index');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'patient_id' => 'required|exists:patients,patient_id',
            'doctor_id' => 'required|exists:doctors,doctor_id',
            'hospital_id' => 'required|exists:hospitals,hospital_id',
            'appointment_date' => 'required|date',
            'reason_for_visit' => 'required|string|max:255',
            'status' => 'required|string|in:scheduled,cancelled,completed',
        ]);

        try {
            $appointment = Appointment::create($validatedData);
            return response()->json(['data' => $appointment, 'message' => 'Appointment created successfully.'], 201);
        } catch (\Exception $e) {
            Log::error('Error creating appointment: ' . $e->getMessage());
            return response()->json(['message' => 'An error occurred while creating the appointment.'], 500);
        }
    }


    // app/Http/Controllers/DoctorAppointmentController.php

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'patient_id' => 'required|exists:patients,patient_id',
            'doctor_id' => 'required|exists:doctors,doctor_id',
            'hospital_id' => 'required|exists:hospitals,hospital_id',
            'appointment_date' => 'required|date',
            'reason_for_visit' => 'required|string|max:255',
            'status' => 'required|string|in:scheduled,cancelled,completed',
        ]);

        try {
            $appointment = Appointment::findOrFail($id);
            $appointment->update($validatedData);
            return response()->json(['data' => $appointment, 'message' => 'Appointment updated successfully.'], 200);
        } catch (\Exception $e) {
            Log::error('Error updating appointment: ' . $e->getMessage());
            return response()->json(['message' => 'An error occurred while updating the appointment.'], 500);
        }
    }

    public function getHospitalId()
    {
        try {
            $user = Auth::user();
            $doctor = Doctor::where('user_id', $user->id)->first();

            if ($doctor) {
                return response()->json(['hospital_id' => $doctor->hospital_id], 200);
            } else {
                return response()->json(['message' => 'Doctor not found.'], 404);
            }
        } catch (\Exception $e) {
            Log::error('Error fetching hospital ID: ' . $e->getMessage());
            return response()->json(['message' => 'An error occurred while fetching the hospital ID.'], 500);
        }
    }

    public function getAllAppointments()
    {
        try {
            $appointments = Appointment::with(['patient', 'doctor', 'hospital'])->get();
            return response()->json(['data' => $appointments], 200);
        } catch (\Exception $e) {
            Log::error('Error fetching appointments: ' . $e->getMessage());
            return response()->json(['message' => 'An error occurred while fetching the appointments.'], 500);
        }
    }

    public function fetch($id)
    {
        try {
            $appointment = Appointment::with(['patient', 'doctor', 'hospital'])->findOrFail($id);
            return response()->json(['data' => $appointment], 200);
        } catch (\Exception $e) {
            Log::error('Error fetching appointment: ' . $e->getMessage());
            return response()->json(['message' => 'An error occurred while fetching the appointment.'], 500);
        }
    }
}
