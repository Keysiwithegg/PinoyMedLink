<?php

namespace Database\Factories;

use App\Models\Hospital;
use Illuminate\Database\Eloquent\Factories\Factory;

class HospitalFactory extends Factory
{
    protected $model = Hospital::class;

    public function definition()
    {
        return [
            'hospital_name' => $this->faker->company,
            'address' => $this->faker->address,
            'contact_number' => $this->faker->phoneNumber,
            'email' => $this->faker->unique()->safeEmail,
            'subscription_id' => $this->faker->uuid,
            'subscription_type' => $this->faker->randomElement(['Basic', 'Starter', 'Enterprise']), // Update this line
        ];
    }
}
