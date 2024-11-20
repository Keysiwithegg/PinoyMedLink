@extends('layouts.patient-app')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Home /</span> Prescriptions</h4>
        <table id="prescriptionsTable" class="table table-hover">
            <thead>
            <tr>
                <th>Prescription ID</th>
                <th>Diagnosis</th>
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
                serverSide: false,
                ajax: '{{ route('patient.prescription.dataTable') }}',
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
                            `;
                        }
                    }
                ],
                language: {
                    emptyTable: "No prescriptions available",
                    info: "Showing _START_ to _END_ of _TOTAL_ entries",
                    infoEmpty: "Showing 0 to 0 of 0 entries",
                    infoFiltered: "(filtered from _MAX_ total entries)",
                    lengthMenu: "Show _MENU_ entries",
                    loadingRecords: "Loading...",
                    processing: "Processing...",
                    search: "Search:",
                    zeroRecords: "No matching records found",
                    paginate: {
                        first: "First",
                        last: "Last",
                        next: "Next",
                        previous: "Previous"
                    }
                }
            });
        });

        function viewRecord(prescriptionId) {
            $.ajax({
                url: `{{ url('/patient/prescription') }}/${prescriptionId}`,
                method: 'GET',
                success: function(response) {
                    const record = response.data;
                    Swal.fire({
                        title: 'Prescription Details',
                        html: `
                            <strong>Diagnosis:</strong> ${record.diagnosis}<br>
                            <strong>Medication Name:</strong> ${record.medication_name}<br>
                            <strong>Dosage:</strong> ${record.dosage}<br>
                            <strong>Frequency:</strong> ${record.frequency}<br>
                            <strong>Duration:</strong> ${record.duration}<br>
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
                    Swal.fire('Error', 'Unable to retrieve the prescription details.', 'error');
                }
            });
        }
    </script>
@endpush
