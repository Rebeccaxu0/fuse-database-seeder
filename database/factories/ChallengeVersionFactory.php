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
    protected $fillable = ['challenge_ategory_id'];

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id' => $this->faker->unique()->randomDigit,
            'challenge_id' => 1,
            'challenge_category_id' => 1,
            'name' => "{\"en\": \"{$this->faker->words(3, true)}\"}",
        ];
    }
}
