<?php

use App\Http\Controllers\AdminAppointmentController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminDoctorController;
use App\Http\Controllers\AdminPatientController;
use App\Http\Controllers\DoctorAppointmentController;
use App\Http\Controllers\DoctorPatientController;
use App\Http\Controllers\DoctorPatientRecordController;
use App\Http\Controllers\DoctorPrescriptionRecordController;
use App\Http\Controllers\PatientAppointmentController;
use App\Http\Controllers\PatientPrescriptionController;
use App\Http\Controllers\PatientProfileController;
use App\Http\Controllers\PatientRecordController;
use App\Http\Controllers\DoctorProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::group(['middleware' => ['twostep']], function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/patient/index', [PatientAppointmentController::class, 'index'])->name('patient.index');
});

//doctor
Route::group(['middleware' => ['doctor.access']], function () {

//doctor
    Route::get('/doctor/patient', [DoctorPatientController::class, 'index'])->name('doctor.patient.index');
    Route::post('/doctor/patient', [DoctorPatientController::class, 'store'])->name('doctor.patient.store');
    Route::get('/doctor/patient/dataTable', [DoctorPatientController::class, 'dataTable'])->name('doctor.patient.dataTable');


    Route::get('/doctor/patient/record', [DoctorPatientRecordController::class, 'index'])->name('doctor.patient.records');

//doctor
    Route::get('/doctor/patient/record', [DoctorPatientRecordController::class, 'index'])->name('doctor.patient.records');
    Route::get('/doctor/patient/record/dataTable', [DoctorPatientRecordController::class, 'dataTable'])->name('doctor.patient.record.dataTable');
    Route::post('/doctor/patient/record/store', [DoctorPatientRecordController::class, 'store'])->name('doctor.patient.record.store');
    Route::get('/doctor/patient/record/{id}', [DoctorPatientRecordController::class, 'viewRecord'])->name('doctor.patient.record.show');
    Route::get('/doctor/patient/record/{id}/edit', [DoctorPatientRecordController::class, 'edit'])->name('doctor.patient.record.edit');
    Route::put('/doctor/patient/record/{id}', [DoctorPatientRecordController::class, 'update'])->name('doctor.patient.record.update');
    Route::delete('/doctor/patient/record/{id}', [DoctorPatientRecordController::class, 'deleteRecord'])->name('doctor.patient.record.destroy');

//doctor prescription
    Route::get('/doctor/prescription', [DoctorPrescriptionRecordController::class, 'index'])->name('doctor.prescription.index');
    Route::get('/doctor/patient/prescription/dataTable', [DoctorPrescriptionRecordController::class, 'dataTable'])->name('doctor.patient.prescription.dataTable');
    Route::post('/doctor/patient/prescription/store', [DoctorPrescriptionRecordController::class, 'store'])->name('doctor.patient.prescription.store');
    Route::get('/doctor/getMedicalRecords', [DoctorPrescriptionRecordController::class, 'getMedicalRecords'])->name('doctor.getMedicalRecords');
    Route::get('/doctor/patient/prescription/{id}', [DoctorPrescriptionRecordController::class, 'show'])->name('doctor.patient.prescription.show');
    Route::get('/doctor/patient/prescription/{id}/edit', [DoctorPrescriptionRecordController::class, 'edit'])->name('doctor.patient.prescription.edit');
    Route::put('/doctor/patient/prescription/{id}', [DoctorPrescriptionRecordController::class, 'update'])->name('doctor.patient.prescription.update');
    Route::delete('/doctor/patient/prescription/{id}', [DoctorPrescriptionRecordController::class, 'destroy'])->name('doctor.patient.prescription.destroy');


//doctor prescription
    Route::get('/doctor/appointment', [DoctorAppointmentController::class, 'index'])->name('doctor.appointment.index');
    Route::post('/doctor/appointment/store', [DoctorAppointmentController::class, 'store'])->name('doctor.appointment.store');
    Route::get('/doctor/appointment/hospital_id', [DoctorAppointmentController::class, 'getHospitalId'])->name('doctor.appointment');
    Route::get('/doctor/appointments', [DoctorAppointmentController::class, 'getAllAppointments'])->name('doctor.appointments');
    Route::put('/doctor/appointment/{id}', [DoctorAppointmentController::class, 'update'])->name('doctor.appointment.update');
    Route::get('/doctor/appointment/fetch/{id}', [DoctorAppointmentController::class, 'fetch'])->name('doctor.appointment.fetch');


    Route::get('/doctor/profile', [DoctorProfileController::class, 'index'])->name('profile.doctor.index');
    Route::post('/doctor/profile/update', [DoctorProfileController::class, 'update'])->name('profile.doctor.update');
});
Route::group(['middleware' => ['patient.access']], function () {

//patient
    Route::get('/patient/record', [PatientRecordController::class, 'index'])->name('patient.record.index');
    Route::get('/patient/record/dataTable', [PatientRecordController::class, 'dataTable'])->name('patient.record.dataTable');
    Route::post('/patient/record/store', [PatientRecordController::class, 'store'])->name('patient.record.store');



    Route::get('/patient/prescription', [PatientPrescriptionController::class, 'index'])->name('patient.prescription.index');
    Route::get('/patient/prescription/dataTable', [PatientPrescriptionController::class, 'dataTable'])->name('patient.prescription.dataTable');
    Route::get('/patient/prescription/{id}', [PatientPrescriptionController::class, 'show'])->name('patient.prescription.show');
    Route::get('/patient/prescription/{id}/edit', [PatientPrescriptionController::class, 'edit'])->name('patient.prescription.edit');
    Route::put('/patient/prescription/{id}', [PatientPrescriptionController::class, 'update'])->name('patient.prescription.update');
    Route::delete('/patient/prescription/{id}', [PatientPrescriptionController::class, 'destroy'])->name('patient.prescription.destroy');

    Route::get('/patient/record/{id}', [PatientRecordController::class, 'show'])->name('patient.record.show');
    Route::get('/patient/record/{id}/edit', [PatientRecordController::class, 'edit'])->name('patient.record.edit');
    Route::put('/patient/record/{id}', [PatientRecordController::class, 'update'])->name('patient.record.update');
    Route::delete('/patient/record/{id}', [PatientRecordController::class, 'destroy'])->name('patient.record.destroy');


    Route::get('/patient/profile', [PatientProfileController::class, 'index'])->name('profile.patient.index');
    Route::post('/patient/profile/update', [PatientProfileController::class, 'update'])->name('profile.patient.update');

    Route::post('/patient/appointment/store', [PatientAppointmentController::class, 'store'])->name('patient.appointment.store');
});

Route::get('/doctor/getPatients', [DoctorPatientRecordController::class, 'getPatients'])->name('doctor.getPatients');
Route::get('/doctors', [PatientRecordController::class, 'getDoctors'])->name('doctors.list');

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);




Route::get('/admin/home', [AdminController::class, 'index'])->name('admin.index');

//admin patient
Route::get('/admin/patients', [AdminPatientController::class, 'index'])->name('admin.patients.index');
Route::get('/admin/patients/data', [AdminPatientController::class, 'dataTable'])->name('admin.patients.data');
Route::post('/admin/patients', [AdminPatientController::class, 'store'])->name('admin.patients.store');


//admin appointment
Route::get('/admin/appointments', [AdminAppointmentController::class, 'index'])->name('admin.appointments.index');
Route::post('/admin/appointments', [AdminAppointmentController::class, 'store'])->name('admin.appointments.store');
Route::put('/admin/appointments/{id}', [AdminAppointmentController::class, 'update'])->name('admin.appointments.update');
Route::get('/admin/appointments/hospital', [AdminAppointmentController::class, 'getHospitalId'])->name('admin.appointment');
Route::get('/admin/appointments/all', [AdminAppointmentController::class, 'getAllAppointments'])->name('admin.appointments');
Route::get('/admin/appointments/fetch/{id}', [AdminAppointmentController::class, 'fetch'])->name('admin.appointment.fetch');


Route::get('/admin/doctors', [AdminDoctorController::class, 'index'])->name('admin.doctors.index');
Route::get('/admin/doctors/create', [AdminDoctorController::class, 'create'])->name('admin.doctors.create');
Route::post('/admin/doctors', [AdminDoctorController::class, 'store'])->name('admin.doctors.store');
Route::get('/admin/doctors/{doctor}', [AdminDoctorController::class, 'show'])->name('admin.doctors.show');
Route::get('/admin/doctors/{doctor}/edit', [AdminDoctorController::class, 'edit'])->name('admin.doctors.edit');
Route::put('/admin/doctors/{doctor}', [AdminDoctorController::class, 'update'])->name('admin.doctors.update');
Route::delete('/admin/doctors/{doctor}', [AdminDoctorController::class, 'destroy'])->name('admin.doctors.destroy');
Route::get('/admin/doctors/dataTable', [AdminDoctorController::class, 'dataTable'])->name('admin.doctors.dataTable');
