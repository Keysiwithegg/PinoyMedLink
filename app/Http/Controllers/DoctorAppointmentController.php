<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DoctorAppointmentController extends Controller
{
    public function index()
    {
        return view('doctor.appointment.index');
    }
}
