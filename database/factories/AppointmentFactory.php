<?php

namespace Database\Factories;

use App\Models\Appointment;
use App\Models\Patient;
use App\Models\Doctor;
use App\Models\Hospital;
use Illuminate\Database\Eloquent\Factories\Factory;

class AppointmentFactory extends Factory
{
    protected $model = Appointment::class;

    public function definition()
    {
        return [
            'patient_id' => Patient::inRandomOrder()->first()->patient_id, // Reference existing patient
            'doctor_id' => Doctor::inRandomOrder()->first()->doctor_id, // Reference existing doctor
            'hospital_id' => Hospital::inRandomOrder()->first()->hospital_id, // Reference existing hospital
            'appointment_date' => $this->faker->dateTime,
            'reason_for_visit' => $this->faker->sentence,
            'status' => $this->faker->randomElement(['scheduled', 'cancelled', 'completed']),
        ];
    }
}
