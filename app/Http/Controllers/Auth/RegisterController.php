<?php

// app/Http/Controllers/Auth/RegisterController.php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Patient;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected function redirectTo()
    {
        $role = auth()->user()->role_id;

        switch ($role) {
            case 0:
                return '/patient/index';
            case 1:
                return '/';
            case 2:
                return '/home';
            default:
                return '/home';
        }
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'date_of_birth' => ['required', 'date'],
            'gender' => ['required', 'string', 'max:10'],
            'contact_number' => ['required', 'string', 'max:15'],
            'address' => ['required', 'string', 'max:500'],
        ]);
    }

    protected function create(array $data)
    {
        $fullName = $data['first_name'] . ' ' . $data['last_name'];
        Log::info('Creating user with name: ' . $fullName);

        $user = User::create([
            'name' => $fullName,
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role_id' => 0, // Set role_id to 0 for patient
        ]);
        Log::info('User created with ID: ' . $user->id);

        Patient::create([
            'user_id' => $user->id,
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'date_of_birth' => $data['date_of_birth'],
            'gender' => $data['gender'],
            'contact_number' => $data['contact_number'],
            'email' => $data['email'],
            'address' => $data['address'],
        ]);
        Log::info('Patient record created for user ID: ' . $user->id);

        return $user;
    }

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();
        $user = $this->create($request->all());
        $this->guard()->login($user); // Log the user in
        return $this->registered($request, $user) ?: redirect($this->redirectPath()); // Redirect the user
    }
}
