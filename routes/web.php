<?php

use App\Http\Controllers\DoctorPatientController;
use App\Http\Controllers\PatientAppointmentController;
use App\Http\Controllers\PatientPrescriptionController;
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

Route::get('patient/index', [PatientAppointmentController::class, 'index'])->name('patient.index');


Route::get('/patient/prescription', [PatientPrescriptionController::class, 'index'])->name('patient.prescription.index');

//doctor
Route::get('/doctor/patient', [DoctorPatientController::class, 'index'])->name('doctor.patient.index');
Route::post('/doctor/patient', [DoctorPatientController::class, 'store'])->name('doctor.patient.store');
Route::get('/doctor/patient/dataTable', [DoctorPatientController::class, 'dataTable'])->name('doctor.patient.dataTable');
Route::get('/patient/record/{id}', [PatientRecordController::class, 'show'])->name('patient.record.show');
Route::get('/patient/record/{id}/edit', [PatientRecordController::class, 'edit'])->name('patient.record.edit');
Route::put('/patient/record/{id}', [PatientRecordController::class, 'update'])->name('patient.record.update');
Route::delete('/patient/record/{id}', [PatientRecordController::class, 'destroy'])->name('patient.record.destroy');
