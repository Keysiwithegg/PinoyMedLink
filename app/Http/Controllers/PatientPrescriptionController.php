<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\Prescription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class PatientPrescriptionController extends Controller
{
    // Display the patient prescription view
    public function index()
    {
        return view('patient.prescription.index');
    }

    // Fetch all prescriptions for the authenticated patient
    public function dataTable()
    {
        try {
            $userId = Auth::id();
            $patient = Patient::where('user_id', $userId)->firstOrFail();
            $patientId = $patient->patient_id;

            // Fetch prescriptions with related medical records
            $records = Prescription::with('medicalRecord')
                ->whereHas('medicalRecord', function ($query) use ($patientId) {
                    $query->where('patient_id', $patientId);
                })
                ->get();

            // Prepare data for response
            $data = $records->map(function ($record) {
                return [
                    'prescription_id' => $record->prescription_id,
                    'diagnosis' => $record->medicalRecord->diagnosis,
                    'medication_name' => $record->medication_name,
                    'dosage' => $record->dosage,
                    'frequency' => $record->frequency,
                    'duration' => $record->duration,
                ];
            });

            return response()->json(['data' => $data]);
        } catch (\Exception $e) {
            Log::error('Error fetching medical records: ' . $e->getMessage());
            return response()->json(['message' => 'An error occurred while fetching the medical records.'], 500);
        }
    }

    // View a specific prescription
    public function show($id)
    {
        try {
            $userId = Auth::id();
            $patient = Patient::where('user_id', $userId)->firstOrFail();
            $patientId = $patient->patient_id;

            // Fetch prescription with related medical record
            $prescription = Prescription::with('medicalRecord')
                ->whereHas('medicalRecord', function ($query) use ($patientId) {
                    $query->where('patient_id', $patientId);
                })
                ->findOrFail($id);

            return response()->json(['data' => $prescription]);
        } catch (\Exception $e) {
            Log::error('Error fetching prescription: ' . $e->getMessage());
            return response()->json(['message' => 'An error occurred while fetching the prescription.'], 500);
        }
    }

    // Edit a specific prescription
    public function edit($id)
    {
        try {
            $userId = Auth::id();
            $prescription = Prescription::with('medicalRecord')
                ->whereHas('medicalRecord', function ($query) use ($userId) {
                    $query->where('patient_id', $userId);
                })
                ->findOrFail($id);

            return response()->json(['data' => $prescription]);
        } catch (\Exception $e) {
            Log::error('Error fetching prescription: ' . $e->getMessage());
            return response()->json(['message' => 'An error occurred while fetching the prescription.'], 500);
        }
    }

    // Update a specific prescription
    public function update(Request $request, $id)
    {
        // Validate the incoming request data
        $request->validate([
            'record_id' => 'required|exists:medical_records,record_id',
            'medication_name' => 'required|string|max:255',
            'dosage' => 'required|string|max:255',
            'frequency' => 'required|string|max:255',
            'duration' => 'required|string|max:255',
        ]);

        try {
            $userId = Auth::id();
            $prescription = Prescription::whereHas('medicalRecord', function ($query) use ($userId) {
                $query->where('patient_id', $userId);
            })->findOrFail($id);

            // Update the prescription
            $prescription->update($request->all());
            return response()->json(['message' => 'Prescription updated successfully.']);
        } catch (\Exception $e) {
            Log::error('Error updating prescription: ' . $e->getMessage());
            return response()->json(['message' => 'An error occurred while updating the prescription.'], 500);
        }
    }

    // Delete a specific prescription
    public function destroy($id)
    {
        try {
            $userId = Auth::id();
            $prescription = Prescription::whereHas('medicalRecord', function ($query) use ($userId) {
                $query->where('patient_id', $userId);
            })->findOrFail($id);

            // Delete the prescription
            $prescription->delete();
            return response()->json(['message' => 'Prescription deleted successfully.']);
        } catch (\Exception $e) {
            Log::error('Error deleting prescription: ' . $e->getMessage());
            return response()->json(['message' => 'An error occurred while deleting the prescription.'], 500);
        }
    }
}
