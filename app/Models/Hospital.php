<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hospital extends Model
{
    protected $table = 'hospitals'; // Correct table name
    protected $primaryKey = 'hospital_id'; // Correct primary key

    protected $fillable = [
        'hospital_name',
        'address',
        'contact_number',
        'email',
        'subscription_id',
        'subscription_type',
    ]; // Correct fillable attributes

    // A hospital can have many doctors
    public function doctors()
    {
        return $this->hasMany(Doctor::class, 'hospital_id', 'hospital_id');
    }

    // A hospital can have many appointments
    public function appointments()
    {
        return $this->hasMany(Appointment::class, 'hospital_id', 'hospital_id');
    }
}
