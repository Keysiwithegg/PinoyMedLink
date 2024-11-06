<?php

namespace Database\Seeders;

use App\Models\MedicalRecord;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MedicalRecordsTableSeeder extends Seeder
{
    public function run()
    {
        MedicalRecord::factory()->count(200)->create();
    }
}
