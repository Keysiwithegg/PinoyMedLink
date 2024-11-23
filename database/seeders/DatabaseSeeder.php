<?php

namespace Database\Seeders;

use App\Models\Hospital;
use App\Models\Patient;
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
        $hospital = Hospital::create([
            'hospital_name' => 'Tondo Foreshore Super Health Center & Lying-In Clinic',
            'address' => 'JX76+Q98, Pacheco St.Tondo, 118 Zone 9, Manila, 1013 Metro Manila',
            'contact_number' => '22545760',
            'email' => 'medical@example.com',
            'subscription_type' => 'Basic',
        ]);

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
            TestAccountSeeder::class
        ]);
    }
}
