<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PatientPrescriptionController extends Controller
{
    public function index()
    {
        return view('patient.prescription.index');
    }
}
