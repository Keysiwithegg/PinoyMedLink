<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\MedicalRecord;
use App\Models\Patient;
use App\Models\Prescription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DoctorPrescriptionRecordController extends Controller
{
    // Display the patient prescription records view for doctors
    public function index()
    {
        return view('doctor.patient-prescription.index');
    }

    // Fetch all prescriptions for DataTables
    public function dataTable(Request $request)
    {
        try {
            $query = Prescription::with('medicalRecord');

            // Apply search filter
            if ($search = $request->input('search.value')) {
                $query->whereHas('medicalRecord', function ($q) use ($search) {
                    $q->where('diagnosis', 'like', "%{$search}%");
                })->orWhere('medication_name', 'like', "%{$search}%");
            }

            // Get total records count
            $totalRecords = $query->count();

            // Apply pagination
            $records = $query->skip($request->input('start'))->take($request->input('length'))->get();

            // Prepare data for DataTables
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

            return response()->json([
                'draw' => $request->input('draw'),
                'recordsTotal' => $totalRecords,
                'recordsFiltered' => $totalRecords,
                'data' => $data,
            ]);
        } catch (\Exception $e) {
            Log::error('Error fetching medical records: ' . $e->getMessage());
            return response()->json(['message' => 'An error occurred while fetching the medical records.'], 500);
        }
    }

    // Store a new prescription
    public function store(Request $request)
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
            Prescription::create($request->all());
            return response()->json(['message' => 'Prescription added successfully.']);
        } catch (\Exception $e) {
            Log::error('Error adding prescription: ' . $e->getMessage());
            return response()->json(['message' => 'An error occurred while adding the prescription.'], 500);
        }
    }

    // Fetch all patients
    public function getPatients()
    {
        try {
            $patients = Patient::all();
            return response()->json($patients);
        } catch (\Exception $e) {
            Log::error('Error fetching patients: ' . $e->getMessage());
            return response()->json(['message' => 'An error occurred while fetching the patients.'], 500);
        }
    }

    // Fetch all medical records for a specific patient
    public function getMedicalRecords(Request $request)
    {
        $patientId = $request->query('patient_id');

        try {
            $medicalRecords = MedicalRecord::where('patient_id', $patientId)->get();
            return response()->json($medicalRecords);
        } catch (\Exception $e) {
            Log::error('Error fetching medical records: ' . $e->getMessage());
            return response()->json(['message' => 'An error occurred while fetching the medical records.'], 500);
        }
    }

    // View a specific prescription
    public function show($id)
    {
        try {
            $prescription = Prescription::with('medicalRecord')->findOrFail($id);
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
            $prescription = Prescription::with('medicalRecord')->findOrFail($id);
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
            $prescription = Prescription::findOrFail($id);
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
            $prescription = Prescription::findOrFail($id);
            $prescription->delete();
            return response()->json(['message' => 'Prescription deleted successfully.']);
        } catch (\Exception $e) {
            Log::error('Error deleting prescription: ' . $e->getMessage());
            return response()->json(['message' => 'An error occurred while deleting the prescription.'], 500);
        }
    }
}
