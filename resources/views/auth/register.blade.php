@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-primary text-white">{{ __('Hospital Registration') }}</div>

                    <div class="card-body">
                        <div class="progress mb-4">
                            <div id="progressBar" class="progress-bar progress-bar-striped progress-bar-animated bg-info" style="width: 33%;"></div>
                        </div>

                        <form id="multiStepForm" method="POST" action="{{ route('register') }}">
                            @csrf
                            <!-- Add hidden field for subscription type -->
                            <input type="hidden" id="subscription_type" name="subscription_type" value="{{ request('subscription_type') }}">
                            <!-- Step 1: User Details -->
                            <div class="form-step" id="step-1">
                                <h4><i class="fas fa-user"></i> User Details</h4>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="name" placeholder="Name" required>
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control" name="email" placeholder="Email" required>
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control" name="password" placeholder="Password" required>
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password" required>
                                </div>
                                <button type="button" class="btn btn-primary" onclick="nextStep(2)">Next</button>
                            </div>

                            <!-- Step 2: Hospital Details -->
                            <div class="form-step" id="step-2" style="display: none;">
                                <h4><i class="fas fa-hospital"></i> Hospital Details</h4>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="hospital_name" placeholder="Hospital Name" required>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="address" placeholder="Address" required>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="contact_number" placeholder="Contact Number" required>
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control" name="hospital_email" placeholder="Hospital Email" required>
                                </div>
                                <button type="button" class="btn btn-secondary" onclick="prevStep(1)">Previous</button>
                                <button type="button" class="btn btn-primary" onclick="nextStep(3)">Next</button>
                            </div>

                            <!-- Step 3: Doctor Details -->
                            <div class="form-step" id="step-3" style="display: none;">
                                <h4><i class="fas fa-user-md"></i> Doctor Details</h4>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="first_name" placeholder="Doctor First Name" required>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="last_name" placeholder="Doctor Last Name" required>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="specialty" placeholder="Specialty" required>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="doctor_contact_number" placeholder="Doctor Contact Number" required>
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control" name="doctor_email" placeholder="Doctor Email" required>
                                </div>
                                <button type="button" class="btn btn-secondary" onclick="prevStep(2)">Previous</button>
                                <button type="submit" class="btn btn-success">Register</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function nextStep(step) {
            document.querySelectorAll('.form-step').forEach(function (step) {
                step.style.display = 'none';
            });
            document.getElementById('step-' + step).style.display = 'block';
            updateProgressBar(step);
        }

        function prevStep(step) {
            document.querySelectorAll('.form-step').forEach(function (step) {
                step.style.display = 'none';
            });
            document.getElementById('step-' + step).style.display = 'block';
            updateProgressBar(step);
        }

        function updateProgressBar(step) {
            let progressBar = document.getElementById('progressBar');
            if (step === 1) progressBar.style.width = '33%';
            if (step === 2) progressBar.style.width = '66%';
            if (step === 3) progressBar.style.width = '100%';
        }
    </script>
@endsection
