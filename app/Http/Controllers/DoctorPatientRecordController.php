<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\MedicalRecord;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DoctorPatientRecordController extends Controller
{
    // Display the patient records view for doctors
    public function index()
    {
        return view('doctor.patient-records.index');
    }

    // Fetch all medical records for DataTables
    public function dataTable()
    {
        try {
            $records = MedicalRecord::all();
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
            $data = $request->all();

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
    public function viewRecord(string $id)
    {
        try {
            $record = MedicalRecord::findOrFail($id);
            return response()->json(['data' => $record]);
        } catch (\Exception $e) {
            Log::error('Error viewing medical record: ' . $e->getMessage());
            return response()->json(['message' => 'An error occurred while retrieving the medical record.'], 500);
        }
    }

    // Delete a specific medical record
    public function deleteRecord(string $id)
    {
        try {
            $record = MedicalRecord::findOrFail($id);
            $record->delete();
            return response()->json(['message' => 'Medical record has been deleted.'], 200);
        } catch (\Exception $e) {
            Log::error('Error deleting medical record: ' . $e->getMessage());
            return response()->json(['message' => 'An error occurred while deleting the medical record.'], 500);
        }
    }

    // Edit a specific medical record
    public function edit(string $id)
    {
        try {
            $record = MedicalRecord::findOrFail($id);
            return response()->json(['data' => $record]);
        } catch (\Exception $e) {
            Log::error('Error editing medical record: ' . $e->getMessage());
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

    // Fetch all doctors
    public function getDoctors()
    {
        $doctors = Doctor::all();
        return response()->json(['data' => $doctors]);
    }

    // Fetch all patients
    public function getPatients()
    {
        try {
            $patients = Patient::all();
            return response()->json(['data' => $patients]);
        } catch (\Exception $e) {
            Log::error('Error fetching patients: ' . $e->getMessage());
            return response()->json(['message' => 'An error occurred while fetching the patients.'], 500);
        }
    }
}
