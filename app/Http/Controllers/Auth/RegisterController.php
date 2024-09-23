<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\Hospital;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{

    use RegistersUsers;
    protected $redirectTo = '/home';
    protected function validator(array $data)
    {


        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'hospital_name' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'contact_number' => ['required', 'string', 'max:15'],
            'hospital_email' => ['required', 'string', 'email', 'max:255'],
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'specialty' => ['required', 'string', 'max:255'],
            'doctor_contact_number' => ['required', 'string', 'max:15'],
            'doctor_email' => ['required', 'string', 'email', 'max:255'],
            'subscription_type' => ['required', 'string', 'max:255'],
        ]);

    }

    protected function create(array $data)
    {



        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        $hospital = Hospital::create([
            'hospital_name' => $data['hospital_name'],
            'address' => $data['address'],
            'contact_number' => $data['contact_number'],
            'email' => $data['hospital_email'],
            'subscription_type' => $data['subscription_type'],
        ]);

        Doctor::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'specialty' => $data['specialty'],
            'contact_number' => $data['doctor_contact_number'],
            'email' => $data['doctor_email'],
            'hospital_id' => $hospital->hospital_id,
            'user_id' => $user->id,
        ]);

        return $user;
    }


    public function register(Request $request)
    {
        $this->validator($request->all())->validate();
        $user = $this->create($request->all());
        $this->guard()->login($user); // Log the user in
        return $this->registered($request, $user) ?: redirect($this->redirectPath()); // Redirect the user
    }

    public function showRegistrationForm(Request $request)
    {
        $subscription_type = $request->query('subscription_type', '');
        return view('auth.register', compact('subscription_type'));
    }
}
