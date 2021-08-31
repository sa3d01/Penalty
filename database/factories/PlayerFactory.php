<?php

namespace Database\Factories;

use App\Models\Academy;
use App\Models\Ad;
use App\Models\Player;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class PlayerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Player::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $ads = Ad::pluck('id')->toArray();
        return [
            'academy_id'=>$this->faker->randomElement(Academy::pluck('id')->toArray()),
            'birth_date' => Carbon::now()->subYears(rand(8,25)),
            'nationality'=>$this->faker->country,
            'nationality_id'=>$this->faker->uuid,
            'ad_id' => $this->faker->randomElement($ads),
        ];
    }
}
