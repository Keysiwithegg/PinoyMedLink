<?php

namespace Database\Factories;

use App\Models\Patient;
use App\Models\User;
use App\Models\Doctor;
use Illuminate\Database\Eloquent\Factories\Factory;

class PatientFactory extends Factory
{
    protected $model = Patient::class;

    public function definition()
    {
        // Get users with role_id = 0
        $userIds = User::where('role_id', 0)->pluck('id');

        // Get doctors whose users have role_id = 2
        $doctorIds = Doctor::whereHas('user', function ($query) {
            $query->where('role_id', 2);
        })->pluck('doctor_id');

        return [
            'user_id' => $this->faker->randomElement($userIds), // Reference user with role_id = 0
            'doctor_id' => $this->faker->randomElement($doctorIds), // Reference doctor with role_id = 2
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'date_of_birth' => $this->faker->date,
            'gender' => $this->faker->randomElement(['male', 'female']),
            'contact_number' => $this->faker->phoneNumber,
            'email' => $this->faker->unique()->safeEmail,
            'address' => $this->faker->address,
        ];
    }
}
