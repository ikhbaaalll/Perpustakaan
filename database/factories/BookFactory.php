<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->firstNameMale(),
            'author' => $this->faker->name(),
            'publisher' => $this->faker->company(),
            'quantity' => rand(10, 50),
            'date_of_entry' => $this->faker->date(),
            'isbn' => $this->faker->isbn10(),
            'description' => $this->faker->realText(200)
        ];
    }
}
