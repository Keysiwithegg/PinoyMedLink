<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DoctorPatientController extends Controller
{
    public function index()
    {
        return view('doctor.patient.index');
    }

    public function dataTable()
    {
        $patients = Doctor::find(Auth::id())->patients()->get();
        return response()->json(['data' => $patients]);
    }
}
