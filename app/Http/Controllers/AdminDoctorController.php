<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Hospital;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AdminDoctorController extends Controller
{
    // Display the list of all doctors
    public function index()
    {
        $doctors = Doctor::all();
        return view('admin.doctor.index', compact('doctors'));
    }

    // Return a JSON response with all doctors
    public function dataTable()
    {
        $doctors = Doctor::all();
        return response()->json(['data' => $doctors]);
    }

    // Return a JSON response indicating that the create method is not supported
    public function create()
    {
        return response()->json(['message' => 'Create method not supported.'], 405);
    }

    // Store a new doctor
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'specialty' => 'required|string|max:255',
            'contact_number' => 'required|string|max:15',
            'email' => 'required|email|unique:doctors,email',
        ]);

        try {
            // Create a new User
            $user = User::create([
                'name' => $validatedData['first_name'] . ' ' . $validatedData['last_name'],
                'email' => $validatedData['email'],
                'role' => 2,
                'password' => bcrypt('defaultpassword'), // Set a default password or generate one
            ]);

            // Get the first hospital
            $hospital = Hospital::first();

            // Create a new Doctor
            $doctor = Doctor::create([
                'first_name' => $validatedData['first_name'],
                'last_name' => $validatedData['last_name'],
                'specialty' => $validatedData['specialty'],
                'contact_number' => $validatedData['contact_number'],
                'email' => $validatedData['email'],
                'hospital_id' => $hospital->hospital_id,
                'user_id' => $user->id,
            ]);

            return response()->json(['data' => $doctor, 'message' => 'Doctor created successfully.'], 201);
        } catch (\Exception $e) {
            // Log the error and return a 500 response
            Log::error('Error creating doctor: ' . $e->getMessage());
            return response()->json(['message' => 'An error occurred while creating the doctor.'], 500);
        }
    }

    // Fetch a specific doctor by ID
    public function show($id)
    {
        try {
            Log::info('Fetching doctor with id: ' . $id);
            $doctor = Doctor::findOrFail($id);
            return response()->json(['data' => $doctor], 200);
        } catch (\Exception $e) {
            // Log the error and return a 404 response
            Log::error('Error fetching doctor: ' . $e->getMessage());
            return response()->json(['message' => 'Doctor not found.'], 404);
        }
    }

    // Return a JSON response indicating that the edit method is not supported
    public function edit($id)
    {
        return response()->json(['message' => 'Edit method not supported.'], 405);
    }

    // Update an existing doctor
    public function update(Request $request, $id)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'specialty' => 'required|string|max:255',
            'contact_number' => 'required|string|max:15',
            'email' => 'required|email|unique:doctors,email,' . $id . ',doctor_id',
        ]);

        try {
            // Find the doctor by ID and update it with the validated data
            $doctor = Doctor::findOrFail($id);
            $doctor->update($validatedData);
            return response()->json(['data' => $doctor, 'message' => 'Doctor updated successfully.'], 200);
        } catch (\Exception $e) {
            // Log the error and return a 500 response
            Log::error('Error updating doctor: ' . $e->getMessage());
            return response()->json(['message' => 'An error occurred while updating the doctor.'], 500);
        }
    }

    // Delete a doctor and associated records
    public function destroy($id)
    {
        \DB::beginTransaction();

        try {
            // Find the doctor by ID
            $doctor = Doctor::findOrFail($id);
            $user = $doctor->user; // Get the associated user

            // Delete related records
            foreach ($doctor->medicalRecords as $record) {
                $record->prescriptions()->delete();
            }
            $doctor->appointments()->delete();
            $doctor->medicalRecords()->delete();
            $doctor->patients()->update(['doctor_id' => null]); // Set doctor_id to null for related patients

            // Delete the doctor and associated user
            $doctor->delete();
            $user->delete();

            \DB::commit();

            return response()->json(['message' => 'Doctor, associated user, and related records deleted successfully.'], 200);
        } catch (\Exception $e) {
            \DB::rollBack();
            // Log the error and return a 500 response
            Log::error('Error deleting doctor: ' . $e->getMessage());
            return response()->json(['message' => 'An error occurred while deleting the doctor.'], 500);
        }
    }
}
