<?php

namespace Database\Factories;

use App\Models\Artifact;
use Illuminate\Database\Eloquent\Factories\Factory;

class ArtifactFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Artifact::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
          'artifactable_type' => 'level',
          //'artifactable_id' => $this->faker->randomDigit(),
        ];
    }
}
