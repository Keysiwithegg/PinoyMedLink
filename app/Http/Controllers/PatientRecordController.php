<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\MedicalRecord;
use Illuminate\Support\Facades\Log;

class PatientRecordController extends Controller
{
    // Display the patient record view
    public function index()
    {
        return view('patient.record.index');
    }

    // Fetch all medical records for the authenticated patient
    public function dataTable()
    {
        try {
            $user_id = Auth::id();
            $patient = Patient::where('user_id', $user_id)->firstOrFail();
            $records = MedicalRecord::where('patient_id', $patient->patient_id)->get();
            return response()->json(['data' => $records]);
        } catch (\Exception $e) {
            Log::error('Error fetching medical records: ' . $e->getMessage());
            return response()->json(['message' => 'An error occurred while fetching the medical records.'], 500);
        }
    }

    // Store a new medical record
    public function store(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'visit_date' => 'required|date',
            'diagnosis' => 'nullable|string',
            'treatment' => 'nullable|string',
            'notes' => 'nullable|string',
            'image' => 'nullable|image'
        ]);

        try {
            $user_id = Auth::id();
            $patient = Patient::where('user_id', $user_id)->firstOrFail();

            $data = $request->all();
            $data['patient_id'] = $patient->patient_id;
            $data['user_id'] = $user_id;

            // Store the image if it exists
            if ($request->hasFile('image')) {
                $data['image'] = $request->file('image')->store('images', 'public');
            }

            // Create a new medical record
            $record = MedicalRecord::create($data);
            return response()->json(['message' => 'Medical record has been added.', 'data' => $record], 201);
        } catch (\Exception $e) {
            Log::error('Error adding medical record: ' . $e->getMessage());
            return response()->json(['message' => 'An error occurred while adding the medical record.'], 500);
        }
    }

    // View a specific medical record
    public function show(string $id)
    {
        try {
            $record = MedicalRecord::find($id);
            return response()->json(['data' => $record]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'An error occurred while retrieving the medical record.'], 500);
        }
    }

    // Edit a specific medical record
    public function edit(string $id)
    {
        try {
            $record = MedicalRecord::find($id);
            return response()->json(['data' => $record]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'An error occurred while editing the medical record.'], 500);
        }
    }

    // Update a specific medical record
    public function update(Request $request, string $id)
    {
        try {
            $record = MedicalRecord::find($id);
            $record->update($request->all());

            return response()->json(['message' => 'Medical record has been updated.'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'An error occurred while updating the medical record.'], 500);
        }
    }

    // Delete a specific medical record
    public function destroy(string $id)
    {
        try {
            $record = MedicalRecord::find($id);
            $record->delete();

            return response()->json(['message' => 'Medical record has been deleted.'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'An error occurred while deleting the medical record.'], 500);
        }
    }

    // Fetch all doctors
    public function getDoctors()
    {
        $doctors = Doctor::all();
        return response()->json(['data' => $doctors]);
    }
}
