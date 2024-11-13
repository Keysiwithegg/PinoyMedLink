<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    protected $table = 'patients'; // Correct table name
    protected $primaryKey = 'patient_id'; // Correct primary key

    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'date_of_birth',
        'gender',
        'contact_number',
        'email',
        'address',
    ]; // Correct fillable attributes

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
