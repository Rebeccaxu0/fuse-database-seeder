<?php

namespace Database\Factories;

use App\Models\Studio;
use App\Util\StudioCode;
use Illuminate\Database\Eloquent\Factories\Factory;

class StudioFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Studio::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => "{$this->faker->title()} {$this->faker->lastName()}'s Period " . rand(1, 9),
            'join_code' => StudioCode::generate(),
        ];
    }
}
