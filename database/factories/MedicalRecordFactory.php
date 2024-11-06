<?php

namespace Database\Factories;

use App\Models\MedicalRecord;
use App\Models\Patient;
use App\Models\Doctor;
use Illuminate\Database\Eloquent\Factories\Factory;

class MedicalRecordFactory extends Factory
{
    protected $model = MedicalRecord::class;

    public function definition()
    {
        return [
            'patient_id' => Patient::inRandomOrder()->first()->patient_id, // Reference existing patient
            'doctor_id' => Doctor::inRandomOrder()->first()->doctor_id, // Reference existing doctor
            'visit_date' => $this->faker->dateTime,
            'diagnosis' => $this->faker->sentence,
            'treatment' => $this->faker->sentence,
            'notes' => $this->faker->paragraph,
            'image' => $this->faker->imageUrl,
        ];
    }
}
