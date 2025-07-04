<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
{
    return [
        'title' => $this->faker->sentence(3),
        'author' => $this->faker->name(),
        'year' => $this->faker->year(),
        'category' => $this->faker->word(),
        'cover_image' => null,
        'description' => $this->faker->paragraph(),
    ];
}

}
