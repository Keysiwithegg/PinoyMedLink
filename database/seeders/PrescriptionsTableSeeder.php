<?php

namespace Database\Seeders;

use App\Models\Prescription;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PrescriptionsTableSeeder extends Seeder
{
    public function run()
    {
        Prescription::factory()->count(200)->create();
    }
}
