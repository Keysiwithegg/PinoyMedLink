<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $table = 'appointments';
    protected $primaryKey = 'appointment_id';

    protected $fillable = [
        'patient_id',
        'doctor_id',
        'hospital_id',
        'appointment_date',
        'reason_for_visit',
        'status',
    ];

    // An appointment belongs to a patient
    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id');
    }

    // An appointment belongs to a doctor
    public function doctor()
    {
        return $this->belongsTo(Doctor::class, 'doctor_id');
    }

    // An appointment belongs to a hospital
    public function hospital()
    {
        return $this->belongsTo(Hospital::class, 'hospital_id');
    }
}

