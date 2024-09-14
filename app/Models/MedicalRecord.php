<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MedicalRecord extends Model
{
    protected $table = 'medical_records'; // Correct table name
    protected $primaryKey = 'record_id'; // Correct primary key

    protected $fillable = [
        'patient_id',
        'doctor_id',
        'visit_date',
        'diagnosis',
        'treatment',
        'notes',
    ]; // Correct fillable attributes

    // A medical record belongs to a patient
    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id');
    }

    // A medical record belongs to a doctor
    public function doctor()
    {
        return $this->belongsTo(Doctor::class, 'doctor_id');
    }

    // A medical record can have many prescriptions
    public function prescriptions()
    {
        return $this->hasMany(Prescription::class, 'record_id');
    }
}
