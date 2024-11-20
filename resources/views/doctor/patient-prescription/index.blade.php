@extends('layouts.app')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Home /</span> Prescriptions</h4>
        <button type="button" class="btn btn-primary mb-3" id="addRecord">
            <span class="tf-icons bx bx-plus"></span>&nbsp; Add Prescription
        </button>
        <table id="prescriptionsTable" class="table table-hover">
            <thead>
            <tr>
                <th>Prescription ID</th>
                <th>Record ID</th>
                <th>Medication Name</th>
                <th>Dosage</th>
                <th>Frequency</th>
                <th>Duration</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#prescriptionsTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route('doctor.patient.prescription.dataTable') }}',
                    type: 'GET',
                    dataSrc: function (json) {
                        if (json.message) {
                            Swal.fire('Error', json.message, 'error');
                            return [];
                        }
                        return json.data;
                    }
                },
                columns: [
                    { data: 'prescription_id', name: 'prescription_id' },
                    { data: 'diagnosis', name: 'diagnosis' },
                    { data: 'medication_name', name: 'medication_name' },
                    { data: 'dosage', name: 'dosage' },
                    { data: 'frequency', name: 'frequency' },
                    { data: 'duration', name: 'duration' },
                    {
                        data: null,
                        name: 'actions',
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row) {
                            return `
                                <button class="btn btn-info btn-sm" onclick="viewRecord(${row.prescription_id})">
                                    <i class="tf-icons bx bx-show"></i>
                                </button>
                                <button class="btn btn-warning btn-sm" onclick="editRecord(${row.prescription_id})">
                                    <i class="tf-icons bx bx-edit"></i>
                                </button>
                                <button class="btn btn-danger btn-sm" onclick="deleteRecord(${row.prescription_id})">
                                    <i class="tf-icons bx bx-trash"></i>
                                </button>
                            `;
                        }
                    }
                ]
            });
        });


            $('#addRecord').on('click', function() {
                $.get('{{ route("doctor.getPatients") }}').done(function(response) {
                    let patients = response.data || response; // Adjust based on your API response structure
                    if (Array.isArray(patients)) {
                        let patientOptions = patients.map(patient => `<option value="${patient.patient_id}">${patient.first_name} ${patient.last_name}</option>`).join('');

                        Swal.fire({
                            title: 'Add Prescription',
                            html: `
                    <div class="mb-3">
                        <label for="patient_id" class="form-label">Patient</label>
                        <select id="patient_id" class="form-control">
                            <option value="">Select Patient</option>
                            ${patientOptions}
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="record_id" class="form-label">Medical Record (Diagnosis)</label>
                        <select id="record_id" class="form-control">
                            <option value="">Select Medical Record</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="medication_name" class="form-label">Medication Name</label>
                        <input id="medication_name" class="form-control" type="text" placeholder="Enter medication name">
                    </div>
                    <div class="mb-3">
                        <label for="dosage" class="form-label">Dosage</label>
                        <input id="dosage" class="form-control" type="text" placeholder="Enter dosage">
                    </div>
                    <div class="mb-3">
                        <label for="frequency" class="form-label">Frequency</label>
                        <input id="frequency" class="form-control" type="text" placeholder="Enter frequency">
                    </div>
                    <div class="mb-3">
                        <label for="duration" class="form-label">Duration</label>
                        <input id="duration" class="form-control" type="text" placeholder="Enter duration">
                    </div>
                `,
                            customClass: {
                                container: 'custom-swal-container', // Add this line
                                popup: 'custom-swal-popup',
                                confirmButton: 'btn btn-primary',
                                cancelButton: 'btn btn-secondary'
                            },
                            showCancelButton: true,
                            confirmButtonText: 'Add',
                            preConfirm: () => {
                                const record_id = $('#record_id').val();
                                const medication_name = $('#medication_name').val();
                                const dosage = $('#dosage').val();
                                const frequency = $('#frequency').val();
                                const duration = $('#duration').val();

                                return $.ajax({
                                    url: '{{ route("doctor.patient.prescription.store") }}',
                                    method: 'POST',
                                    data: {
                                        record_id: record_id,
                                        medication_name: medication_name,
                                        dosage: dosage,
                                        frequency: frequency,
                                        duration: duration
                                    }
                                }).then(response => {
                                    Swal.fire('Success', 'Prescription added successfully.', 'success');
                                    $('#prescriptionsTable').DataTable().ajax.reload();
                                }).catch(error => {
                                    Swal.fire('Error', 'An error occurred while adding the prescription.', 'error');
                                });
                            }
                        });

                        $('#patient_id').on('change', function() {
                            const patientId = $(this).val();
                            if (patientId) {
                                $.get(`{{ url('/doctor/getMedicalRecords') }}?patient_id=${patientId}`).done(function(medicalRecords) {
                                    let medicalRecordOptions = medicalRecords.map(record => `<option value="${record.record_id}">${record.diagnosis}</option>`).join('');
                                    $('#record_id').html(medicalRecordOptions);
                                }).fail(function() {
                                    Swal.fire('Error', 'Unable to fetch medical records.', 'error');
                                });
                            } else {
                                $('#record_id').html('<option value="">Select Medical Record</option>');
                            }
                        });
                    } else {
                        Swal.fire('Error', 'Unable to fetch patients.', 'error');
                    }
                }).fail(function() {
                    Swal.fire('Error', 'Unable to fetch patients.', 'error');
                });
            });


        // View Record functionality
        function viewRecord(prescriptionId) {
            $.ajax({
                url: `{{ url('/doctor/patient/prescription') }}/${prescriptionId}`,
                method: 'GET',
                success: function(response) {
                    const record = response.data;
                    Swal.fire({
                        title: 'Prescription Details',
                        html: `
                            <strong>Diagnosis:</strong> ${record.medical_record.diagnosis}<br>
                            <strong>Medication Name:</strong> ${record.medication_name}<br>
                            <strong>Dosage:</strong> ${record.dosage}<br>
                            <strong>Frequency:</strong> ${record.frequency}<br>
                            <strong>Duration:</strong> ${record.duration}<br>
                        `
                    });
                },
                error: function() {
                    Swal.fire('Error', 'Unable to retrieve the prescription details.', 'error');
                }
            });
        };

        // Edit Record functionality
        window.editRecord = function(prescriptionId) {
            $.ajax({
                url: `{{ url('/doctor/patient/prescription') }}/${prescriptionId}/edit`,
                method: 'GET',
                success: function(response) {
                    const record = response.data;
                    Swal.fire({
                        title: 'Edit Prescription',
                        html: `
                                <div class="mb-3">
                                    <label for="edit_medication_name" class="form-label">Medication Name</label>
                                    <input id="edit_medication_name" class="form-control" type="text" value="${record.medication_name}">
                                </div>
                                <div class="mb-3">
                                    <label for="edit_dosage" class="form-label">Dosage</label>
                                    <input id="edit_dosage" class="form-control" type="text" value="${record.dosage}">
                                </div>
                                <div class="mb-3">
                                    <label for="edit_frequency" class="form-label">Frequency</label>
                                    <input id="edit_frequency" class="form-control" type="text" value="${record.frequency}">
                                </div>
                                <div class="mb-3">
                                    <label for="edit_duration" class="form-label">Duration</label>
                                    <input id="edit_duration" class="form-control" type="text" value="${record.duration}">
                                </div>
                            `,
                        showCancelButton: true,
                        confirmButtonText: 'Update',
                        preConfirm: () => {
                            const medication_name = $('#edit_medication_name').val();
                            const dosage = $('#edit_dosage').val();
                            const frequency = $('#edit_frequency').val();
                            const duration = $('#edit_duration').val();

                            return $.ajax({
                                url: `{{ url('/doctor/patient/prescription') }}/${prescriptionId}`,
                                method: 'PUT',
                                data: {
                                    medication_name,
                                    dosage,
                                    frequency,
                                    duration
                                }
                            }).then(response => {
                                Swal.fire('Success', 'Prescription has been updated.', 'success');
                                $('#prescriptionsTable').DataTable().ajax.reload();
                            }).catch(error => {
                                Swal.fire('Error', 'An error occurred while updating the prescription.', 'error');
                            });
                        }
                    });
                },
                error: function() {
                    Swal.fire('Error', 'Unable to retrieve the prescription details for editing.', 'error');
                }
            });
        };

        // Delete Record functionality
        window.deleteRecord = function(prescriptionId) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: `{{ url('/doctor/patient/prescription') }}/${prescriptionId}`,
                        method: 'DELETE',
                        success: function() {
                            Swal.fire('Deleted!', 'Prescription has been deleted.', 'success');
                            $('#prescriptionsTable').DataTable().ajax.reload();
                        },
                        error: function() {
                            Swal.fire('Error', 'Unable to delete the prescription.', 'error');
                        }
                    });
                }
            });
        };
    </script>
@endpush
