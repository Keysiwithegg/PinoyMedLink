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
                        @foreach($appointments as $appointment)
                    {
                        title: '{{ $appointment->patient->first_name }} {{ $appointment->patient->last_name }} with {{ $appointment->doctor->first_name }} {{ $appointment->doctor->last_name }}',
                        start: '{{ $appointment->appointment_date }}',
                        end: '{{ \Carbon\Carbon::parse($appointment->appointment_date)->addHour() }}'
                    },
                    @endforeach
                ]
            });
            calendar.render();
        });

        function createAppointment() {
            Swal.fire({
                title: 'Create Appointment',
                html: `
                    <div class="mb-3">
                        <label for="doctor_id" class="form-label">Doctor</label>
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
                    const doctorId = document.getElementById('doctor_id').value;
                    const appointmentDate = document.getElementById('appointment_date').value;
                    const reasonForVisit = document.getElementById('reason_for_visit').value;
                    const status = document.getElementById('status').value;

                    return fetch('{{ route('patient.appointment.store') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            doctor_id: doctorId,
                            appointment_date: appointmentDate,
                            reason_for_visit: reasonForVisit,
                            status: status
                        })
                    })
                        .then(response => {
                            if (!response.ok) {
                                throw new Error(response.statusText);
                            }
                            return response.json();
                        })
                        .then(data => {
                            Swal.fire({
                                title: 'Success!',
                                text: 'Appointment created successfully.',
                                icon: 'success',
                                confirmButtonText: 'OK'
                            }).then(() => {
                                location.reload();
                            });
                        })
                        .catch(error => {
                            Swal.fire({
                                title: 'Error!',
                                text: 'There was an error creating the appointment.',
                                icon: 'error',
                                confirmButtonText: 'OK'
                            });
                        });
                }
            });

            const doctorSelect = document.getElementById('doctor_id');

            // Clear existing options
            doctorSelect.innerHTML = '';

            // Fetch doctors data from the server
            fetch('/doctors')
                .then(response => response.json())
                .then(data => {
                    const doctors = data.data;
                    doctors.forEach(doctor => {
                        const option = document.createElement('option');
                        option.value = doctor.doctor_id;
                        option.text = `${doctor.first_name} ${doctor.last_name}`;
                        doctorSelect.appendChild(option);
                    });
                });
        }
    </script>

    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js'></script>
@endpush
