<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\ClassRoom;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            'nama'=>\fake()->name(),
            'email'=>\fake()->unique()->safeEmail(),
            'alamat'=>fake()->address(),
            'class_rooms_id'=> ClassRoom::factory(),
            'tanggal_lahir'=>\fake()->date()
        ];
    }
}
