<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\MedicalRecord;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DoctorPatientRecordController extends Controller
{
    public function index()
    {
        return view('doctor.patient-records.index');
    }

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

    public function store(Request $request)
    {
        $request->validate([
            'visit_date' => 'required|date',
            'diagnosis' => 'nullable|string',
            'treatment' => 'nullable|string',
            'notes' => 'nullable|string',
            'image' => 'nullable|image'
        ]);

        try {
            $data = $request->all();

            if ($request->hasFile('image')) {
                $data['image'] = $request->file('image')->store('images', 'public');
            }

            $record = MedicalRecord::create($data);
            return response()->json(['message' => 'Medical record has been added.', 'data' => $record], 201);
        } catch (\Exception $e) {
            Log::error('Error adding medical record: ' . $e->getMessage());
            return response()->json(['message' => 'An error occurred while adding the medical record.'], 500);
        }
    }

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


    public function getDoctors()
    {
        $doctors = Doctor::all();
        return response()->json(['data' => $doctors]);
    }

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
