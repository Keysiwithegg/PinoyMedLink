@extends('layouts.admin-app')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Home /</span> Admin Appointments</h4>
        <button type="button" class="btn btn-primary mb-3" id="addRecord" onclick="createAppointment()">
            <span class="tf-icons bx bx-plus"></span>&nbsp; Add Appointment
        </button>
        <div id="calendar"></div>
    </div>
@endsection

@push('scripts')
    <script>
        var calendar; // Declare the calendar variable globally

        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek'
                },
                events: function(fetchInfo, successCallback, failureCallback) {
                    fetch('{{ route('admin.appointments') }}')
                        .then(response => response.json())
                        .then(data => {
                            if (data.data) {
                                const events = data.data.map(appointment => ({
                                    id: appointment.appointment_id,
                                    title: `${appointment.patient.first_name} ${appointment.patient.last_name} with Dr. ${appointment.doctor.first_name} ${appointment.doctor.last_name}`,
                                    start: appointment.appointment_date,
                                    description: appointment.reason_for_visit,
                                    status: appointment.status
                                }));
                                successCallback(events);
                            } else {
                                failureCallback('No appointments found.');
                            }
                        })
                        .catch(error => {
                            console.error('Error fetching appointments:', error);
                            failureCallback('An error occurred while fetching the appointments.');
                        });
                },
                eventClick: function(info) {
                    updateAppointment(info.event.id);
                }
            });
            calendar.render();
        });

        function createAppointment() {
            fetch('{{ route('admin.appointment') }}')
                .then(response => response.json())
                .then(data => {
                    if (data.hospital_id) {
                        const hospital_id = data.hospital_id;

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
                            customClass: {
                                container: 'custom-swal-container',
                                popup: 'custom-swal-popup',
                                confirmButton: 'btn btn-primary',
                                cancelButton: 'btn btn-secondary'
                            },
                            showCancelButton: true,
                            confirmButtonText: 'Create',
                            preConfirm: () => {
                                const patient_id = document.getElementById('patient_id').value;
                                const doctor_id = document.getElementById('doctor_id').value;
                                const appointment_date = document.getElementById('appointment_date').value;
                                const reason_for_visit = document.getElementById('reason_for_visit').value;
                                const status = document.getElementById('status').value;

                                return fetch('{{ route('admin.appointments.store') }}', {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/json',
                                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                    },
                                    body: JSON.stringify({
                                        patient_id,
                                        doctor_id,
                                        hospital_id,
                                        appointment_date,
                                        reason_for_visit,
                                        status
                                    })
                                })
                                    .then(response => response.json())
                                    .then(data => {
                                        if (data.message) {
                                            Swal.fire({
                                                title: 'Success!',
                                                text: data.message,
                                                icon: 'success',
                                                confirmButtonText: 'OK'
                                            }).then(() => {
                                                calendar.refetchEvents(); // Refresh the calendar events
                                            });
                                        } else {
                                            Swal.fire({
                                                title: 'Error!',
                                                text: 'An error occurred while creating the appointment.',
                                                icon: 'error',
                                                confirmButtonText: 'OK'
                                            });
                                        }
                                    })
                                    .catch(error => {
                                        Swal.fire({
                                            title: 'Error!',
                                            text: 'An error occurred while creating the appointment.',
                                            icon: 'error',
                                            confirmButtonText: 'OK'
                                        });
                                    });
                            }
                        });

                        fetch('{{ route('doctor.getPatients') }}')
                            .then(response => response.json())
                            .then(response => {
                                const patients = response.data;
                                const patientSelect = document.getElementById('patient_id');
                                patients.forEach(patient => {
                                    const option = document.createElement('option');
                                    option.value = patient.patient_id;
                                    option.text = `${patient.first_name} ${patient.last_name}`;
                                    patientSelect.appendChild(option);
                                });
                            });

                        fetch('{{ route('doctors.list') }}')
                            .then(response => response.json())
                            .then(response => {
                                const doctors = response.data;
                                const doctorSelect = document.getElementById('doctor_id');
                                doctors.forEach(doctor => {
                                    const option = document.createElement('option');
                                    option.value = doctor.doctor_id;
                                    option.text = `${doctor.first_name} ${doctor.last_name}`;
                                    doctorSelect.appendChild(option);
                                });
                            });
                    } else {
                        Swal.fire({
                            title: 'Error!',
                            text: 'Doctor not found.',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    }
                })
                .catch(error => {
                    Swal.fire({
                        title: 'Error!',
                        text: 'An error occurred while fetching the hospital ID.',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                });
        }

        function updateAppointment(appointmentId) {
            fetch('{{ route('admin.appointment') }}')
                .then(response => response.json())
                .then(data => {
                    if (data.hospital_id) {
                        const hospital_id = data.hospital_id;

                        fetch(`{{ url('/admin/appointments/fetch') }}/${appointmentId}`)
                            .then(response => response.json())
                            .then(appointmentData => {
                                if (appointmentData.data) {
                                    const appointment = appointmentData.data;

                                    Swal.fire({
                                        title: 'Update Appointment',
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
                                        <input id="appointment_date" class="form-control" type="datetime-local" value="${appointment.appointment_date}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="reason_for_visit" class="form-label">Reason for Visit</label>
                                        <input id="reason_for_visit" class="form-control" type="text" value="${appointment.reason_for_visit}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="status" class="form-label">Status</label>
                                        <select id="status" class="form-control">
                                            <option value="scheduled" ${appointment.status === 'scheduled' ? 'selected' : ''}>Scheduled</option>
                                            <option value="cancelled" ${appointment.status === 'cancelled' ? 'selected' : ''}>Cancelled</option>
                                            <option value="completed" ${appointment.status === 'completed' ? 'selected' : ''}>Completed</option>
                                        </select>
                                    </div>
                                `,
                                        showCancelButton: true,
                                        confirmButtonText: 'Update',
                                        preConfirm: () => {
                                            const patient_id = document.getElementById('patient_id').value;
                                            const doctor_id = document.getElementById('doctor_id').value;
                                            const appointment_date = document.getElementById('appointment_date').value;
                                            const reason_for_visit = document.getElementById('reason_for_visit').value;
                                            const status = document.getElementById('status').value;

                                            return fetch(`{{ url('/admin/appointments') }}/${appointmentId}`, {
                                                method: 'PUT',
                                                headers: {
                                                    'Content-Type': 'application/json',
                                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                                },
                                                body: JSON.stringify({
                                                    patient_id,
                                                    doctor_id,
                                                    hospital_id,
                                                    appointment_date,
                                                    reason_for_visit,
                                                    status
                                                })
                                            })
                                                .then(response => response.json())
                                                .then(data => {
                                                    if (data.message) {
                                                        Swal.fire({
                                                            title: 'Success!',
                                                            text: data.message,
                                                            icon: 'success',
                                                            confirmButtonText: 'OK'
                                                        }).then(() => {
                                                            calendar.refetchEvents(); // Refresh the calendar events
                                                        });
                                                    } else {
                                                        Swal.fire({
                                                            title: 'Error!',
                                                            text: 'An error occurred while updating the appointment.',
                                                            icon: 'error',
                                                            confirmButtonText: 'OK'
                                                        });
                                                    }
                                                })
                                                .catch(error => {
                                                    Swal.fire({
                                                        title: 'Error!',
                                                        text: 'An error occurred while updating the appointment.',
                                                        icon: 'error',
                                                        confirmButtonText: 'OK'
                                                    });
                                                });
                                        }
                                    });

                                    fetch('{{ route('doctor.getPatients') }}')
                                        .then(response => response.json())
                                        .then(response => {
                                            const patients = response.data;
                                            const patientSelect = document.getElementById('patient_id');
                                            patients.forEach(patient => {
                                                const option = document.createElement('option');
                                                option.value = patient.patient_id;
                                                option.text = `${patient.first_name} ${patient.last_name}`;
                                                if (patient.patient_id === appointment.patient_id) {
                                                    option.selected = true;
                                                }
                                                patientSelect.appendChild(option);
                                            });
                                        });

                                    fetch('{{ route('doctors.list') }}')
                                        .then(response => response.json())
                                        .then(response => {
                                            const doctors = response.data;
                                            const doctorSelect = document.getElementById('doctor_id');
                                            doctors.forEach(doctor => {
                                                const option = document.createElement('option');
                                                option.value = doctor.doctor_id;
                                                option.text = `${doctor.first_name} ${doctor.last_name}`;
                                                if (doctor.doctor_id === appointment.doctor_id) {
                                                    option.selected = true;
                                                }
                                                doctorSelect.appendChild(option);
                                            });
                                        });
                                } else {
                                    Swal.fire({
                                        title: 'Error!',
                                        text: 'Appointment not found.',
                                        icon: 'error',
                                        confirmButtonText: 'OK'
                                    });
                                }
                            })
                            .catch(error => {
                                Swal.fire({
                                    title: 'Error!',
                                    text: 'An error occurred while fetching the appointment details.',
                                    icon: 'error',
                                    confirmButtonText: 'OK'
                                });
                            });
                    } else {
                        Swal.fire({
                            title: 'Error!',
                            text: 'Doctor not found.',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    }
                })
                .catch(error => {
                    Swal.fire({
                        title: 'Error!',
                        text: 'An error occurred while fetching the hospital ID.',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                });
        }
    </script>
@endpush
