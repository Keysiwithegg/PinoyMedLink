<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PatientAppointmentController extends Controller
{
    public function index()
    {
        return view('patient.index');
    }


}
