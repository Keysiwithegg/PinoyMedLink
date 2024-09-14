<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $table = 'patients';
    protected $primaryKey = 'patient_id';

    protected $fillable = [
        'first_name',
        'last_name',
        'date_of_birth',
        'gender',
        'contact_number',
        'email',
        'address',
    ];

    // A patient can have many appointments
    public function appointments()
    {
        return $this->hasMany(Appointment::class, 'patient_id');
    }

    // A patient can have many medical records
    public function medicalRecords()
    {
        return $this->hasMany(MedicalRecord::class, 'patient_id');
    }
}
