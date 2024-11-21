@extends('layouts.admin-app')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Home /</span> Doctors</h4>

        <button type="button" class="btn btn-primary mb-3" id="addDoctor">
            <span class="tf-icons bx bx-plus"></span>&nbsp; Add Doctor
        </button>

        <table id="dataTable" class="table table-hover">
            <thead>
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Specialty</th>
                <th>Contact Number</th>
                <th>Email</th>
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

            $('#dataTable').DataTable({
                "bDestroy": true,
                ajax: '{{ route("doctors.list") }}',
                columns: [
                    { data: 'first_name', name: 'first_name' },
                    { data: 'last_name', name: 'last_name' },
                    { data: 'specialty', name: 'specialty' },
                    { data: 'contact_number', name: 'contact_number' },
                    { data: 'email', name: 'email' },
                    {
                        data: 'doctor_id', // Ensure this matches the primary key in your database
                        name: 'actions',
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row) {
                            return `
                    <button class="btn btn-warning btn-sm" onclick="editDoctor(${data})">
                        <i class="tf-icons bx bx-edit"></i>
                    </button>
                    <button class="btn btn-danger btn-sm" onclick="deleteDoctor(${data})">
                        <i class="tf-icons bx bx-trash"></i>
                    </button>
                `;
                        }
                    }
                ]
            });

            $('#addDoctor').on('click', function() {
                Swal.fire({
                    title: 'Add Doctor',
                    html: `
            <div class="mb-3">
                <label for="first_name" class="form-label">First Name</label>
                <input id="first_name" class="form-control" type="text" placeholder="Enter first name">
            </div>
            <div class="mb-3">
                <label for="last_name" class="form-label">Last Name</label>
                <input id="last_name" class="form-control" type="text" placeholder="Enter last name">
            </div>
            <div class="mb-3">
                <label for="specialty" class="form-label">Specialty</label>
                <input id="specialty" class="form-control" type="text" placeholder="Enter specialty">
            </div>
            <div class="mb-3">
                <label for="contact_number" class="form-label">Contact Number</label>
                <input id="contact_number" class="form-control" type="text" placeholder="Enter contact number">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input id="email" class="form-control" type="email" placeholder="Enter email">
            </div>
        `, customClass: {
                        container: 'custom-swal-container', // Add this line
                        popup: 'custom-swal-popup',
                        confirmButton: 'btn btn-primary',
                        cancelButton: 'btn btn-secondary'
                    },
                    showCancelButton: true,
                    confirmButtonText: 'Add',
                    preConfirm: () => {
                        const first_name = $('#first_name').val();
                        const last_name = $('#last_name').val();
                        const specialty = $('#specialty').val();
                        const contact_number = $('#contact_number').val();
                        const email = $('#email').val();

                        if (!first_name || !last_name || !specialty || !contact_number || !email) {
                            Swal.showValidationMessage('Please fill out all fields');
                            return false;
                        }

                        return $.ajax({
                            url: '{{ route("admin.doctors.store") }}',
                            method: 'POST',
                            data: {
                                first_name,
                                last_name,
                                specialty,
                                contact_number,
                                email
                            }
                        }).then(response => {
                            Swal.fire('Success', 'Doctor has been added.', 'success');
                            $('#dataTable').DataTable().ajax.reload();
                        }).catch(error => {
                            Swal.fire('Error', 'An error occurred while adding the doctor.', 'error');
                        });
                    }
                });
            });
        });

        function editDoctor(doctorId) {
            fetch(`{{ url('/admin/doctors') }}/${doctorId}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Doctor not found');
                    }
                    return response.json();
                })
                .then(data => {
                    const doctor = data.data;
                    Swal.fire({
                        title: 'Edit Doctor',
                        html: `
                    <div class="mb-3">
                        <label for="first_name" class="form-label">First Name</label>
                        <input id="first_name" class="form-control" type="text" value="${doctor.first_name}">
                    </div>
                    <div class="mb-3">
                        <label for="last_name" class="form-label">Last Name</label>
                        <input id="last_name" class="form-control" type="text" value="${doctor.last_name}">
                    </div>
                    <div class="mb-3">
                        <label for="specialty" class="form-label">Specialty</label>
                        <input id="specialty" class="form-control" type="text" value="${doctor.specialty}">
                    </div>
                    <div class="mb-3">
                        <label for="contact_number" class="form-label">Contact Number</label>
                        <input id="contact_number" class="form-control" type="text" value="${doctor.contact_number}">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input id="email" class="form-control" type="email" value="${doctor.email}">
                    </div>
                `, customClass: {
                            container: 'custom-swal-container', // Add this line
                            popup: 'custom-swal-popup',
                            confirmButton: 'btn btn-primary',
                            cancelButton: 'btn btn-secondary'
                        },
                        showCancelButton: true,
                        confirmButtonText: 'Update',
                        preConfirm: () => {
                            const first_name = $('#first_name').val();
                            const last_name = $('#last_name').val();
                            const specialty = $('#specialty').val();
                            const contact_number = $('#contact_number').val();
                            const email = $('#email').val();

                            return fetch(`{{ url('/admin/doctors') }}/${doctorId}`, {
                                method: 'PUT',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                },
                                body: JSON.stringify({
                                    first_name,
                                    last_name,
                                    specialty,
                                    contact_number,
                                    email
                                })
                            })
                                .then(response => response.json())
                                .then(data => {
                                    if (data.message) {
                                        Swal.fire('Success!', data.message, 'success').then(() => {
                                            $('#dataTable').DataTable().ajax.reload();
                                        });
                                    } else {
                                        Swal.fire('Error!', 'An error occurred while updating the doctor.', 'error');
                                    }
                                })
                                .catch(error => {
                                    Swal.fire('Error!', 'An error occurred while updating the doctor.', 'error');
                                });
                        }
                    });
                })
                .catch(error => {
                    Swal.fire('Error!', 'Doctor not found.', 'error');
                });
        }

        function deleteDoctor(doctorId) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!', customClass: {
                    container: 'custom-swal-container', // Add this line
                    popup: 'custom-swal-popup',
                    confirmButton: 'btn btn-primary',
                    cancelButton: 'btn btn-secondary'
                },
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch(`{{ url('/admin/doctors') }}/${doctorId}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    })
                        .then(response => response.json())
                        .then(data => {
                            if (data.message) {
                                Swal.fire('Deleted!', data.message, 'success').then(() => {
                                    $('#dataTable').DataTable().ajax.reload();
                                });
                            } else {
                                Swal.fire('Error!', 'An error occurred while deleting the doctor.', 'error');
                            }
                        })
                        .catch(error => {
                            Swal.fire('Error!', 'An error occurred while deleting the doctor.', 'error');
                        });
                }
            });
        }
    </script>
@endpush
