<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Appointment;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // Constructor to apply middleware for authentication and admin access
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin.access'); // Add this line
    }

    // Display the admin dashboard with counts of doctors, patients, and today's appointments
    public function index()
    {
        $doctorCount = $this->countDoctor();
        $patientCount = $this->countPatient();
        $appointmentCount = $this->countAppointment();

        return view('admin.index', compact('doctorCount', 'patientCount', 'appointmentCount'));
    }

    // Count the total number of doctors
    public function countDoctor()
    {
        return Doctor::count();
    }

    // Count the total number of patients
    public function countPatient()
    {
        return Patient::count();
    }

    // Count the number of appointments scheduled for today
    public function countAppointment()
    {
        return Appointment::whereDate('appointment_date', today())->count();
    }
}
