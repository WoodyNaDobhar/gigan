<?php

namespace Database\Factories;

use App\Models\Flexer;
use Illuminate\Database\Eloquent\Factories\Factory;

class FlexerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Flexer::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'orkID' => $this->faker->word,
        'rank' => $this->faker->word
        ];
    }
}
