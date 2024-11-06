<!-- resources/views/patient/index.blade.php -->
@extends('layouts.patient-app')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Home /</span> Appointment</h4>
        <button type="button" class="btn btn-primary mb-3" id="addRecord" onclick="createAppointment()">
            <span class="tf-icons bx bx-plus"></span>&nbsp; Add Appointment
        </button>
        <div id="calendar"></div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'timeGridWeek',
                events: [
                    {
                        title: 'John Doe with Dr. Smith',
                        start: '2023-10-02T09:00:00',
                        end: '2023-10-02T10:00:00'
                    },
                    {
                        title: 'Jane Doe with Dr. Brown',
                        start: '2023-10-03T11:00:00',
                        end: '2023-10-03T12:00:00'
                    },
                    {
                        title: 'Alice Johnson with Dr. White',
                        start: '2023-10-04T14:00:00',
                        end: '2023-10-04T15:00:00'
                    },
                    {
                        title: 'Bob Smith with Dr. Green',
                        start: '2023-10-05T10:00:00',
                        end: '2023-10-05T11:00:00'
                    },
                    {
                        title: 'Charlie Brown with Dr. Black',
                        start: '2023-10-06T13:00:00',
                        end: '2023-10-06T14:00:00'
                    }
                ]
            });
            calendar.render();
        });


        function createAppointment() {
            Swal.fire({
                title: 'Create Appointment',
                html: `
                    <div class="mb-3">
                        <label for="patient_id" class="form-label">Patient ID</label>
                        <select id="patient_id" class="form-control"></select>
                    </div>
                    <div class="mb-3">
                        <label for="doctor_id" class="form-label">Doctor ID</label>
                        <select id="doctor_id" class="form-control"></select>
                    </div>
                    <div class="mb-3">
                        <label for="appointment_date" class="form-label">Appointment Date</label>
                        <input id="appointment_date" class="form-control" type="datetime-local">
                    </div>
                    <div class="mb-3">
                        <label for="reason_for_visit" class="form-label">Reason for Visit</label>
                        <input id="reason_for_visit" class="form-control" type="text" placeholder="Enter reason for visit">
                    </div>
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select id="status" class="form-control">
                            <option value="scheduled">Scheduled</option>
                            <option value="cancelled">Cancelled</option>
                            <option value="completed">Completed</option>
                        </select>
                    </div>
                `,
                showCancelButton: true,
                confirmButtonText: 'Create',
                preConfirm: () => {
                    // Dummy Swal for appointment creation
                    Swal.fire({
                        title: 'Success!',
                        text: 'Your appointment is awaiting approval.',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    });
                }
            });

            // Fetch patients and doctors data (dummy data for now)
            const patients = [
                { patient_id: 1, first_name: 'John', last_name: 'Doe' },
                { patient_id: 2, first_name: 'Jane', last_name: 'Doe' }
            ];
            const doctors = [
                { doctor_id: 1, first_name: 'Dr. Smith', last_name: '' },
                { doctor_id: 2, first_name: 'Dr. Brown', last_name: '' }
            ];

            const patientSelect = document.getElementById('patient_id');
            patients.forEach(patient => {
                const option = document.createElement('option');
                option.value = patient.patient_id;
                option.text = `${patient.first_name} ${patient.last_name}`;
                patientSelect.appendChild(option);
            });

            const doctorSelect = document.getElementById('doctor_id');
            doctors.forEach(doctor => {
                const option = document.createElement('option');
                option.value = doctor.doctor_id;
                option.text = `${doctor.first_name} ${doctor.last_name}`;
                doctorSelect.appendChild(option);
            });
        }
    </script>

    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js'></script>
@endpush
