@extends('layouts.guest-app')

@section('content')
    <div class="login-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12 text-center">
                    <h1 class="welcome-text">Welcome Back</h1>
                    <p class="access-text">Access your Tondo Foreshore Super Health Center account</p>
                </div>
                <div class="col-lg-4">
                    <div class="login-card">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="form-group">
                                <label>Email Address</label>
                                <input type="email"
                                       class="form-control @error('email') is-invalid @enderror"
                                       name="email"
                                       value="{{ old('email') }}"
                                       required>
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Password</label>
                                <input type="password"
                                       class="form-control @error('password') is-invalid @enderror"
                                       name="password"
                                       required>
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group remember-group">
                                <label class="checkbox-label">
                                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <span>Remember Me</span>
                                </label>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="login-btn">
                                    LOGIN
                                </button>
                            </div>

                            <div class="forgot-password">
                                @if (Route::has('password.request'))
                                    <a href="{{ route('password.request') }}">
                                        Forgot Your Password?
                                    </a>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .login-section {
            min-height: 100vh;
            background-color: #f5f6f7;
            padding-top: 80px;
        }

        .welcome-text {
            color: #2d3748;
            font-size: 28px;
            font-weight: 600;
            margin-bottom: 8px;
        }

        .access-text {
            color: #718096;
            margin-bottom: 30px;
        }

        .login-card {
            background: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #4a5568;
            font-size: 14px;
        }

        .form-control {
            width: 100%;
            padding: 10px;
            border: 1px solid #e2e8f0;
            border-radius: 5px;
            font-size: 14px;
        }

        .form-control:focus {
            border-color: #457B4B;
            box-shadow: none;
            outline: none;
        }

        .remember-group {
            margin: 15px 0;
        }

        .checkbox-label {
            display: flex;
            align-items: center;
            cursor: pointer;
            font-size: 14px;
            color: #4a5568;
        }

        .checkbox-label input {
            margin-right: 8px;
        }

        .login-btn {
            width: 100%;
            padding: 10px;
            background: #457B4B;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            transition: background-color 0.2s;
        }

        .login-btn:hover {
            background: #3d6b42;
        }

        .forgot-password {
            text-align: center;
            margin-top: 15px;
        }

        .forgot-password a {
            color: #457B4B;
            font-size: 14px;
            text-decoration: none;
        }

        .forgot-password a:hover {
            text-decoration: underline;
        }

        @media (max-width: 768px) {
            .login-section {
                padding: 40px 20px;
            }

            .login-card {
                margin: 0 15px;
            }
        }
    </style>
@endsection
