<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Patient;
use App\Models\User;

class PatientsTableSeeder extends Seeder
{
    /**
     * Seed the patients table.
     */
    public function run(): void
    {
        // Get users with role_id = 0
        $userIds = User::where('role_id', 0)->pluck('id');

        // Create patients for each user with role_id = 0
        foreach ($userIds as $userId) {
            Patient::factory()->create(['user_id' => $userId]);
        }
    }
}
