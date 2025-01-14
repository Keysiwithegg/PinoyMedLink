<?php

namespace Database\Seeders;

use App\Models\Doctor;
use App\Models\Patient;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class TestAccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //create admin account

        User::create([
            'name' => 'Back Door',
            'email' => 'joshua.pardo30@gmail.com',
            'password' => Hash::make('Test@123'),
            'role_id' => 1,
        ]);

        User::create([
            'name' => 'Admin User',
            'email' => 'sheenrodrigazo@gmail.com',
            'password' => Hash::make('Test@123'),
            'role_id' => 1,
        ]);

        // Create a user for the doctor
        $user = User::create([
            'name' => 'Cleo Alcanzo',
            'email' => 'cleoalcanzo123@gmail.com',
            'password' => Hash::make('Test@123'), // Use a secure password
            'role_id' => 2, // Assuming role_id 2 is for doctors
        ]);

        // Create the doctor associated with the user
        Doctor::create([
            'first_name' => 'Cleo',
            'last_name' => 'Alcanzo',
            'specialty' => 'Cardiology', // Specify the specialty
            'contact_number' => '1234567890', // Provide a contact number
            'email' => 'cleoalcanzo123@gmail.com',
            'hospital_id' => 1, // Assuming you have a hospital created
            'user_id' => $user->id,
        ]);


        // Create a user for the patient
        $user = User::create([
            'name' => 'Charmie Montes',
            'email' => 'charmiemontes02@gmail.com',
            'password' => Hash::make('Test@123'), // Use a secure password
            'role_id' => 0, // Assuming role_id 0 is for patients
        ]);

        // Create the patient associated with the user
        Patient::create([
            'first_name' => 'Charmie',
            'last_name' => 'Montes',
            'date_of_birth' => '1992-05-15', // Provide a date of birth
            'gender' => 'Female', // Specify the gender
            'contact_number' => '0987654321', // Provide a contact number
            'email' => 'charmiemontes02@gmail.com',
            'address' => '456 Elm St, Anytown, USA', // Provide an address
            'user_id' => $user->id,
        ]);

    }
}
