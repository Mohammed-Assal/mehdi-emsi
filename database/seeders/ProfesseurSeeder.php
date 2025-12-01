<?php

namespace Database\Seeders;

use App\Models\Professeur;
use Illuminate\Database\Seeder;

class ProfesseurSeeder extends Seeder
{
    public function run(): void
    {
        Professeur::factory()->count(20)->create();
    }
}
