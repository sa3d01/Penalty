<?php

namespace Database\Factories;

use App\Models\Academy;
use App\Models\Coach;
use Illuminate\Database\Eloquent\Factories\Factory;

class CoachFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Coach::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'sport_id' => 1,
            'academy_id' => $this->faker->randomElement(Academy::pluck('id')->toArray()),
            'city' => $this->faker->city,
            'nationality' => $this->faker->country,
            'nationality_id' => $this->faker->uuid,
        ];
    }

}
