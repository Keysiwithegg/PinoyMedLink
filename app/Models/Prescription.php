<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{
    protected $table = 'prescriptions';
    protected $primaryKey = 'prescription_id';

    protected $fillable = [
        'record_id',
        'medication_name',
        'dosage',
        'frequency',
        'duration',
    ];

    // A prescription belongs to a medical record
    public function medicalRecord()
    {
        return $this->belongsTo(MedicalRecord::class, 'record_id');
    }
}
