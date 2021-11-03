<?php

namespace Database\Factories;

use App\Models\ChallengeCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

class ChallengeCategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ChallengeCategory::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //'id' => $this->faker->unique()->randomDigit,
            'name' => $this->faker->word(),
            'description' => $this->faker->words(5, true),
        ];
    }
}
