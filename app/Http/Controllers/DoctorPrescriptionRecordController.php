<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DoctorPrescriptionRecordController extends Controller
{
    public function index()
    {
        return view('doctor.patient-prescription.index');
    }
}
