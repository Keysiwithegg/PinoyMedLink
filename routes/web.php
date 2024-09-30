<?php

use App\Http\Controllers\DoctorPatientController;
use App\Http\Controllers\PatientRecordController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);


//patient
Route::get('/patient/record', [PatientRecordController::class, 'index'])->name('patient.record.index');
Route::get('/patient/record/dataTable', [PatientRecordController::class, 'dataTable'])->name('patient.record.dataTable');
Route::post('/patient/record/store', [PatientRecordController::class, 'store'])->name('patient.record.store');
Route::get('/doctors', [PatientRecordController::class, 'getDoctors'])->name('doctors.list');


//doctor
Route::get('/doctor/patient', [DoctorPatientController::class, 'index'])->name('doctor.patient.index');
Route::get('/doctor/patient/dataTable', [DoctorPatientController::class, 'dataTable'])->name('doctor.patient.dataTable');
