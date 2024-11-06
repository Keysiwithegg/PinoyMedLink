<?php

// app/Models/Doctor.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;
    protected $table = 'doctors';
    protected $primaryKey = 'doctor_id';

    protected $fillable = [
        'first_name',
        'last_name',
        'specialty',
        'contact_number',
        'email',
        'hospital_id',
        'user_id', // Add this line
    ];

    public function hospital()
    {
        return $this->belongsTo(Hospital::class, 'hospital_id');
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class, 'doctor_id');
    }

    public function medicalRecords()
    {
        return $this->hasMany(MedicalRecord::class, 'doctor_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id'); // Add this method
    }

    public function patients()
    {
        return $this->hasMany(Patient::class, 'doctor_id');
    }
}
