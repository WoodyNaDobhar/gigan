<?php

namespace Database\Factories;

use App\Models\Challenge;
use Illuminate\Database\Eloquent\Factories\Factory;

class ChallengeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Challenge::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'challenger_id' => $this->faker->word,
        'challenged_id' => $this->faker->word,
        'week_id' => $this->faker->word,
        'winner_id' => $this->faker->word,
        'challenged_at' => $this->faker->date('Y-m-d H:i:s'),
        'challenger_rank' => $this->faker->word,
        'challenged_rank' => $this->faker->word,
        'video' => $this->faker->word
        ];
    }
}
