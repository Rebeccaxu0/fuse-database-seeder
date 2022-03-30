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
    protected $fillable = ['challenge_category_id', 'name'];

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //'id' => $this->faker->randomDigit,
            'challenge_id' => 1,
            'challenge_category_id' => 1,
            'name' => $this->faker->words(3, true),
        ];
    }
}
