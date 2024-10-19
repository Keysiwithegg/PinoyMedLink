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
    public function index()
    {
        return view('doctor.patient-prescription.index');
    }

    public function dataTable()
    {
        try {
            $records = Prescription::with('medicalRecord')->get();
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

    // In `app/Http/Controllers/DoctorPrescriptionRecordController.php`
    public function store(Request $request)
    {
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

    // In `app/Http/Controllers/DoctorPrescriptionRecordController.php`

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

    public function update(Request $request, $id)
    {
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
