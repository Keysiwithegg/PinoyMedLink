<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    protected $table = 'doctors';
    protected $primaryKey = 'doctor_id';

    protected $fillable = [
        'first_name',
        'last_name',
        'specialty',
        'contact_number',
        'email',
        'hospital_id',
    ];

    // A doctor belongs to a hospital
    public function hospital()
    {
        return $this->belongsTo(Hospital::class, 'hospital_id');
    }

    // A doctor can have many appointments
    public function appointments()
    {
        return $this->hasMany(Appointment::class, 'doctor_id');
    }

    // A doctor can have many medical records
    public function medicalRecords()
    {
        return $this->hasMany(MedicalRecord::class, 'doctor_id');
    }
}
