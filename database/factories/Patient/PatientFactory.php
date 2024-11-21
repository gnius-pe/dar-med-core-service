<?php

namespace Database\Factories\Patient;

use App\Models\Patient\Patient;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Patient>
 */
class PatientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'identification_type' => $this->faker->randomElement(['DNI', 'PPT']),
            'identification_number' => $this->faker->unique()->numerify('#########'),
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'email' => $this->faker->unique()->safeEmail,
            'birth_date' => $this->faker->date(),
            'first_phone' => $this->faker->phoneNumber,
            'second_phone' => $this->faker->optional()->phoneNumber,
            'gender' => $this->faker->randomElement(['M', 'F', 'NONE']),
            'message' => $this->faker->optional()->sentence,
            'medical_examination' => $this->faker->boolean,
            'spiritual_support' => $this->faker->boolean,
            'permission_to_call' => $this->faker->boolean,
            'visit_condition' => $this->faker->randomElement(['urgent', 'program', 'inactive']),
            'spiritual_diagnosis' => $this->faker->optional()->sentence,
        ];
    }
}
