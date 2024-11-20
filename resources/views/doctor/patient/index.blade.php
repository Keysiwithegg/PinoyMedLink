@extends('layouts.app')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Home /</span> Patients</h4>

        <button type="button" class="btn btn-primary mb-3" id="addRecord">
            <span class="tf-icons bx bx-plus"></span>&nbsp; Add Record
        </button>

        <table id="dataTable" class="table table-hover">
            <thead>
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Date of Birth</th>
                <th>Gender</th>
                <th>Contact Number</th>
                <th>Email</th>
                <th>Address</th>
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
                ajax: '{{ route("doctor.patient.dataTable") }}',
                columns: [
                    { data: 'first_name', name: 'first_name' },
                    { data: 'last_name', name: 'last_name' },
                    { data: 'date_of_birth', name: 'date_of_birth' },
                    { data: 'gender', name: 'gender' },
                    { data: 'contact_number', name: 'contact_number' },
                    { data: 'email', name: 'email' },
                    { data: 'address', name: 'address' }
                ]
            });

            $('#addRecord').on('click', function() {
                Swal.fire({
                    title: 'Add Patient Record',
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
                            <label for="date_of_birth" class="form-label">Date of Birth</label>
                            <input id="date_of_birth" class="form-control" type="date" placeholder="Enter date of birth">
                        </div>
                        <div class="mb-3">
                            <label for="gender" class="form-label">Gender</label>
                            <select id="gender" class="form-control">
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="contact_number" class="form-label">Contact Number</label>
                            <input id="contact_number" class="form-control" type="text" placeholder="Enter contact number">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input id="email" class="form-control" type="email" placeholder="Enter email">
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">Address</label>
                            <textarea id="address" class="form-control" placeholder="Enter address"></textarea>
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
                        const first_name = $('#first_name').val();
                        const last_name = $('#last_name').val();
                        const date_of_birth = $('#date_of_birth').val();
                        const gender = $('#gender').val();
                        const contact_number = $('#contact_number').val();
                        const email = $('#email').val();
                        const address = $('#address').val();

                        return $.ajax({
                            url: '{{ route("doctor.patient.store") }}',
                            method: 'POST',
                            data: {
                                first_name,
                                last_name,
                                date_of_birth,
                                gender,
                                contact_number,
                                email,
                                address
                            }
                        }).then(response => {
                            Swal.fire('Success', 'Patient record has been added.', 'success');
                            $('#dataTable').DataTable().ajax.reload();
                        }).catch(error => {
                            Swal.fire('Error', 'An error occurred while adding the patient record.', 'error');
                        });
                    }
                });
            });
        });
    </script>
@endpush
