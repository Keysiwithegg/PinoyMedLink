<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hospital extends Model
{
    protected $table = 'hospitals';
    protected $primaryKey = 'hospital_id';

    protected $fillable = [
        'hospital_name',
        'address',
        'contact_number',
        'email',
        'subscription_id',
        'subscription_type',
    ];

    // A hospital can have many doctors
    public function doctors()
    {
        return $this->hasMany(Doctor::class, 'hospital_id');
    }

    // A hospital can have many appointments
    public function appointments()
    {
        return $this->hasMany(Appointment::class, 'hospital_id');
    }
}
