<?php

namespace Database\Factories;

use App\Models\Doctor;
use App\Models\User;
use App\Models\Hospital;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Log;

class DoctorFactory extends Factory
{
    protected $model = Doctor::class;

    public function definition()
    {
        // Get the only created hospital
        $hospitalId = Hospital::first()->hospital_id;
        Log::info('Hospital ID: ' . $hospitalId);
        return [
            'user_id' => User::where('role_id', 2)->inRandomOrder()->first()->id, // Reference existing user with role_id = 2
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'specialty' => $this->faker->word,
            'contact_number' => $this->faker->phoneNumber,
            'email' => $this->faker->unique()->safeEmail,
            'hospital_id' => $hospitalId, // Reference the only created hospital
        ];
    }
}
