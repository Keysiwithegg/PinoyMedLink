<?php

namespace Database\Seeders;

use App\Models\Hospital;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Doctor;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        //create user
        User::create([
            'name' => 'Admin User',
            'email' => 'joshua.pardo30@gmail.com',
            'password' => Hash::make('Test@123'),
            'role_id' => 1,
        ]);



        $hospital = Hospital::create([
            'hospital_name' => 'Laguna Medical Center',
            'address' => '123 Laguna St., Calamba, Laguna',
            'contact_number' => '09123456789',
            'email' => 'laguna_medical@example.com',
            'subscription_type' => 'Basic',
        ]);

        Log::info("The hospital id:" . $hospitalId = $hospital->hospital_id);

        // Create 10 users with role_id = 2
        $usersWithRole2 = User::factory()->count(10)->create(['role_id' => 2]);

        // Create doctors for each user with role_id = 2
        foreach ($usersWithRole2 as $user) {
            Doctor::factory()->create(['user_id' => $user->id]);
        }

        // Create 100 users with role_id = 0
        User::factory()->count(100)->create(['role_id' => 0]);


        $this->call([
            PatientsTableSeeder::class,
            MedicalRecordsTableSeeder::class,
            PrescriptionsTableSeeder::class,
            AppointmentsTableSeeder::class,
        ]);
    }
}
