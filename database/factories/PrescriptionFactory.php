<?php

namespace Database\Factories;

use App\Models\Prescription;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Prescription>
 */
class PrescriptionFactory extends Factory
{
    protected $model = Prescription::class;

    public function definition()
    {
        return [
            'record_id' => \App\Models\MedicalRecord::factory(),
            'medication_name' => $this->faker->word,
            'dosage' => $this->faker->word,
            'frequency' => $this->faker->word,
            'duration' => $this->faker->word,
        ];
    }
}
