@extends('layouts.app')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Home /</span> Medical Records</h4>

        <button type="button" class="btn btn-primary mb-3" id="addRecord">
            <span class="tf-icons bx bx-plus"></span>&nbsp; Add Record
        </button>

        <table id="dataTable" class="table table-hover">
            <thead>
            <tr>
                <th>Visit Date</th>
                <th>Diagnosis</th>
                <th>Treatment</th>
                <th>Notes</th>
                <th>Actions</th> <!-- New Actions Column -->
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

            $('#dataTable').DataTable({
                "bDestroy": true,
                ajax: '{{ route("doctor.patient.record.dataTable") }}',
                columns: [
                    {
                        data: 'visit_date',
                        name: 'visit_date',
                        render: function(data) {
                            const date = new Date(data);
                            const options = { year: 'numeric', month: 'long', day: 'numeric' };
                            return date.toLocaleDateString('en-US', options);
                        }
                    },
                    { data: 'diagnosis', name: 'diagnosis' },
                    { data: 'treatment', name: 'treatment' },
                    { data: 'notes', name: 'notes' },
                    {
                        data: null,
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row) {
                            return `
                        <div class="d-flex justify-content-around">
                            <a href="#" class="btn btn-info btn-sm mx-1" title="View" onclick="viewRecord(${row.record_id})">
                                <i class="bx bx-show"></i>
                            </a>
                            <a href="#" class="btn btn-warning btn-sm mx-1" title="Edit" onclick="editRecord(${row.record_id})">
                                <i class="bx bx-edit"></i>
                            </a>
                            <a href="#" class="btn btn-danger btn-sm mx-1" title="Delete" onclick="deleteRecord(${row.record_id})">
                                <i class="bx bx-trash"></i>
                            </a>
                        </div>`;
                        }
                    }
                ]
            });

            $('#addRecord').on('click', function() {
                $.get('{{ route("doctor.getPatients") }}', function(response) {
                    if (response.data && response.data.length > 0) {
                        // Sort patients alphabetically by first name and last name
                        response.data.sort((a, b) => {
                            const nameA = `${a.first_name} ${a.last_name}`.toLowerCase();
                            const nameB = `${b.first_name} ${b.last_name}`.toLowerCase();
                            return nameA.localeCompare(nameB);
                        });

                        let patientOptions = '';
                        response.data.forEach(patient => {
                            patientOptions += `<option value="${patient.patient_id}">${patient.first_name} ${patient.last_name}</option>`;
                        });

                        Swal.fire({
                            title: 'Add Medical Record',
                            html: `
                    <div class="mb-3">
                        <label for="visit_date" class="form-label">Visit Date</label>
                        <input id="visit_date" class="form-control" type="date" placeholder="Enter visit date">
                    </div>
                    <div class="mb-3">
                        <label for="diagnosis" class="form-label">Diagnosis</label>
                        <input id="diagnosis" class="form-control" type="text" placeholder="Enter diagnosis">
                    </div>
                    <div class="mb-3">
                        <label for="treatment" class="form-label">Treatment</label>
                        <input id="treatment" class="form-control" type="text" placeholder="Enter treatment">
                    </div>
                    <div class="mb-3">
                        <label for="notes" class="form-label">Notes</label>
                        <textarea id="notes" class="form-control" placeholder="Enter notes"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="patient" class="form-label">Patient</label>
                        <select id="patient" class="form-control">
                            ${patientOptions}
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Image</label>
                        <input id="image" class="form-control" type="file">
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
                                const visit_date = $('#visit_date').val();
                                const diagnosis = $('#diagnosis').val();
                                const treatment = $('#treatment').val();
                                const notes = $('#notes').val();
                                const patient_id = $('#patient').val();
                                const image = $('#image')[0].files[0];

                                const formData = new FormData();
                                formData.append('visit_date', visit_date);
                                formData.append('diagnosis', diagnosis);
                                formData.append('treatment', treatment);
                                formData.append('notes', notes);
                                formData.append('patient_id', patient_id);
                                formData.append('doctor_id', '{{ Auth::user()->id }}');
                                if (image) {
                                    formData.append('image', image);
                                }

                                return $.ajax({
                                    url: '{{ route("doctor.patient.record.store") }}',
                                    method: 'POST',
                                    data: formData,
                                    processData: false,
                                    contentType: false
                                }).then(response => {
                                    Swal.fire('Success', 'Medical record has been added.', 'success');
                                    $('#dataTable').DataTable().ajax.reload();
                                }).catch(error => {
                                    Swal.fire('Error', 'An error occurred while adding the medical record.', 'error');
                                });
                            }
                        });
                    } else {
                        Swal.fire('Error', 'No patients found.', 'error');
                    }
                }).fail(function() {
                    Swal.fire('Error', 'Unable to fetch patients.', 'error');
                });
            });

            window.editRecord = function(recordId) {
                $.ajax({
                    url: `{{ url('/doctor/patient/record') }}/${recordId}/edit`,
                    method: 'GET',
                    success: function(response) {
                        const record = response.data;
                        Swal.fire({
                            title: 'Edit Medical Record',
                            html: `
                            <div class="mb-3">
                                <label for="edit_visit_date" class="form-label">Visit Date</label>
                                <input id="edit_visit_date" class="form-control" type="date" value="${record.visit_date}">
                            </div>
                            <div class="mb-3">
                                <label for="edit_diagnosis" class="form-label">Diagnosis</label>
                                <input id="edit_diagnosis" class="form-control" type="text" value="${record.diagnosis}">
                            </div>
                            <div class="mb-3">
                                <label for="edit_treatment" class="form-label">Treatment</label>
                                <input id="edit_treatment" class="form-control" type="text" value="${record.treatment}">
                            </div>
                            <div class="mb-3">
                                <label for="edit_notes" class="form-label">Notes</label>
                                <textarea id="edit_notes" class="form-control">${record.notes}</textarea>
                            </div>
                            <div class="mb-3">
                                <label for="edit_image" class="form-label">Image</label>
                                <input id="edit_image" class="form-control" type="file">
                            </div>
                        `,
                            customClass: {
                                container: 'custom-swal-container', // Add this line
                                popup: 'custom-swal-popup',
                                confirmButton: 'btn btn-primary',
                                cancelButton: 'btn btn-secondary'
                            },
                            showCancelButton: true,
                            confirmButtonText: 'Update',
                            preConfirm: () => {
                                const visit_date = $('#edit_visit_date').val();
                                const diagnosis = $('#edit_diagnosis').val();
                                const treatment = $('#edit_treatment').val();
                                const notes = $('#edit_notes').val();
                                const image = $('#edit_image')[0].files[0];

                                const formData = new FormData();
                                formData.append('_method', 'PUT');
                                formData.append('visit_date', visit_date);
                                formData.append('diagnosis', diagnosis);
                                formData.append('treatment', treatment);
                                formData.append('notes', notes);
                                if (image) {
                                    formData.append('image', image);
                                }

                                return $.ajax({
                                    url: `{{ url('/doctor/patient/record') }}/${recordId}`,
                                    method: 'POST',
                                    data: formData,
                                    processData: false,
                                    contentType: false
                                }).then(response => {
                                    Swal.fire('Success', 'Medical record has been updated.', 'success');
                                    $('#dataTable').DataTable().ajax.reload();
                                }).catch(error => {
                                    Swal.fire('Error', 'An error occurred while updating the medical record.', 'error');
                                });
                            }
                        });
                    },
                    error: function() {
                        Swal.fire('Error', 'Unable to retrieve the record details for editing.', 'error');
                    }
                });
            };

            window.viewRecord = function(recordId) {
                $.ajax({
                    url: `{{ url('/doctor/patient/record') }}/${recordId}`,
                    method: 'GET',
                    success: function(response) {
                        let imageHtml = '';
                        if (response.data.image) {
                            imageHtml = `<div class="mb-3"><img src="{{ asset('storage') }}/${response.data.image}" class="img-fluid" alt="Medical Record Image"></div>`;
                        }
                        Swal.fire({
                            title: 'Medical Record Details',
                            html: `
                            ${imageHtml}
                            <strong>Visit Date:</strong> ${response.data.visit_date}<br>
                            <strong>Diagnosis:</strong> ${response.data.diagnosis}<br>
                            <strong>Treatment:</strong> ${response.data.treatment}<br>
                            <strong>Notes:</strong> ${response.data.notes}<br>
                        `,
                            customClass: {
                                container: 'custom-swal-container', // Add this line
                                popup: 'custom-swal-popup',
                                confirmButton: 'btn btn-primary',
                                cancelButton: 'btn btn-secondary'
                            },
                        });
                    },
                    error: function() {
                        Swal.fire('Error', 'Unable to retrieve the record details.', 'error');
                    }
                });
            };

            window.deleteRecord = function(recordId) {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: `{{ url('/doctor/patient/record') }}/${recordId}`,
                            method: 'DELETE',
                            success: function() {
                                Swal.fire('Deleted!', 'Record has been deleted.', 'success');
                                $('#dataTable').DataTable().ajax.reload();
                            },
                            error: function() {
                                Swal.fire('Error', 'Unable to delete the record.', 'error');
                            }
                        });
                    }
                });
            };
        });
    </script>
@endpush
