@extends('layouts.patient-app')

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
                ajax: '{{ route("patient.record.dataTable") }}',
                columns: [
                    { data: 'visit_date', name: 'visit_date' },
                    { data: 'diagnosis', name: 'diagnosis' },
                    { data: 'treatment', name: 'treatment' },
                    { data: 'notes', name: 'notes' }
                ]
            });

            $('#addRecord').on('click', function() {
                $.get('{{ route("doctors.list") }}', function(response) {
                    let doctorOptions = '';
                    response.data.forEach(doctor => {
                        doctorOptions += `<li><a class="dropdown-item" href="javascript:void(0);" data-id="${doctor.doctor_id}">${doctor.first_name} ${doctor.last_name}</a></li>`;
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
                                <label for="doctor" class="form-label">Doctor</label>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                        Select Doctor
                                    </button>
                                    <ul class="dropdown-menu" id="doctorDropdown">
                                        ${doctorOptions}
                                    </ul>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="image" class="form-label">Image</label>
                                <input id="image" class="form-control" type="file">
                            </div>
                        `,
                        showCancelButton: true,
                        confirmButtonText: 'Add',
                        preConfirm: () => {
                            const visit_date = $('#visit_date').val();
                            const diagnosis = $('#diagnosis').val();
                            const treatment = $('#treatment').val();
                            const notes = $('#notes').val();
                            const doctor_id = $('#doctorDropdown .dropdown-item.active').data('id');
                            const image = $('#image')[0].files[0];

                            const formData = new FormData();
                            formData.append('visit_date', visit_date);
                            formData.append('diagnosis', diagnosis);
                            formData.append('treatment', treatment);
                            formData.append('notes', notes);
                            formData.append('doctor_id', doctor_id);
                            if (image) {
                                formData.append('image', image);
                            }

                            return $.ajax({
                                url: '{{ route("patient.record.store") }}',
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

                    $('#doctorDropdown .dropdown-item').on('click', function() {
                        $('#doctorDropdown .dropdown-item').removeClass('active');
                        $(this).addClass('active');
                        $('.btn-group .dropdown-toggle').text($(this).text());
                    });
                });
            });
        });
    </script>
@endpush
