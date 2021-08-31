<?php

namespace Database\Factories;

use App\Models\Academy;
use App\Models\Ad;
use Illuminate\Database\Eloquent\Factories\Factory;

class AcademyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Academy::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $ads = Ad::pluck('id')->toArray();
        return [
            'ad_id' => $this->faker->randomElement($ads),
            'country_id' => 2,
            'city' => $this->faker->city,
            'district' => $this->faker->citySuffix,
            'location' => [
                'lat' => $this->faker->latitude,
                'lng' => $this->faker->longitude,
            ],
            'academy_size_id' => $this->faker->randomElement([2, 3, 4, 5]),
        ];
    }
}
