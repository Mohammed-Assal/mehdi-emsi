<?php

namespace Database\Factories;

use App\Models\Professeur;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProfesseurFactory extends Factory
{
    protected $model = Professeur::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'password' => bcrypt('password'), // or Hash::make('password')
            'matricule' => $this->faker->unique()->numerify('MAT###'),
        ];
    }
}
