<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Appointment;
use Illuminate\Http\Request;

class AdminController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin.access'); // Add this line
    }

    public function index()
    {
        $doctorCount = $this->countDoctor();
        $patientCount = $this->countPatient();
        $appointmentCount = $this->countAppointment();

        return view('admin.index', compact('doctorCount', 'patientCount', 'appointmentCount'));
    }

    public function countDoctor()
    {
        return Doctor::count();
    }

    public function countPatient()
    {
        return Patient::count();
    }

    public function countAppointment()
    {
        return Appointment::whereDate('appointment_date', today())->count();
    }
}
