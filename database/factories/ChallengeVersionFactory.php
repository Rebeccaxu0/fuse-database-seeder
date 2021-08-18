<?php

namespace Database\Factories;

use App\Models\ChallengeVersion;
use Illuminate\Database\Eloquent\Factories\Factory;

class ChallengeVersionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ChallengeVersion::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id' => $this->faker->randomDigit(),
            'created_at' => $this->faker->unixTime(),
            'updated_at' => $this->faker->unixTime(),
            'challenge_id' => 1,
            'challenge_category_id' => 1,
            'name' => "{\"en\": \"{$this->faker->words(3, true)}\"}",
            'd7_id' => 1,
            'd7_challenge_id' => 1,
            'd7_challenge_category_id' => 1,
        ];
    }
}
