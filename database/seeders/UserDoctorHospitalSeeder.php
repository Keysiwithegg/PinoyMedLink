<?php

namespace Database\Seeders;

use App\Models\Doctor;
use App\Models\Hospital;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserDoctorHospitalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Create a sample user
        $user = User::create([
            'name' => 'John Doe',
            'email' => 'joshua.pardo30@gmail.com',
            'password' => Hash::make('Test@123'), // Example password
        ]);

        // Create a sample hospital
        $hospital = Hospital::create([
            'hospital_name' => 'Laguna Medical Center',
            'address' => '123 Laguna St., Calamba, Laguna',
            'contact_number' => '09123456789',
            'email' => 'laguna_medical@example.com',
            'subscription_type' => 'Basic', // Example subscription type
        ]);

        // Create a sample doctor linked to the hospital and user
        Doctor::create([
            'first_name' => 'James',
            'last_name' => 'Smith',
            'specialty' => 'Cardiology',
            'contact_number' => '09123456788',
            'email' => 'james.smith@example.com',
            'hospital_id' => $hospital->hospital_id,
            'user_id' => $user->id,
        ]);
    }
}
