<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{

    use HasFactory;

    protected $table = 'prescriptions'; // Correct table name
    protected $primaryKey = 'prescription_id'; // Correct primary key

    protected $fillable = [
        'record_id',
        'medication_name',
        'dosage',
        'frequency',
        'duration',
    ]; // Correct fillable attributes

    // A prescription belongs to a medical record
    public function medicalRecord()
    {
        return $this->belongsTo(MedicalRecord::class, 'record_id');
    }
}
