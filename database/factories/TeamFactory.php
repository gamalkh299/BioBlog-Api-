<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Team;

class TeamFactory extends Factory
{
    /**
    * The name of the factory's corresponding model.
    *
    * @var  string
    */
    protected $model = Team::class;

    /**
    * Define the model's default state.
    *
    * @return  array
    */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'image' => $this->faker->imageUrl,
            'job' => $this->faker->word,
            'twitter' => $this->faker->title,
            'facebook' => $this->faker->title,
            'whatsapp' => $this->faker->phoneNumber,
        ];
    }
}
