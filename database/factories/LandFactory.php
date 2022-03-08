<?php

namespace Database\Factories;

use App\Models\Land;
use Illuminate\Database\Eloquent\Factories\Factory;

class LandFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Land::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'kingdom_id' => $this->faker->word,
        'label' => $this->faker->word,
        'description' => $this->faker->text,
        'image' => $this->faker->word
        ];
    }
}
