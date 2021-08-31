<?php

namespace Database\Factories;

use App\Models\Activity;
use App\Models\Group;
use App\Models\GroupDay;
use App\Models\Sport;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class GroupFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Group::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $days = [
            ['Thursday', 'Tuesday', 'Sunday'],
            ['Wednesday', 'Monday', 'Saturday'],
            ['Tuesday', 'Thursday'],
        ];
        $sports=Sport::pluck('id')->toArray();
        return [
            'name' => $this->faker->title,
            'sport_id' => $this->faker->randomElement($sports),
            'price' => rand(100, 1000),
            'days' => $this->faker->randomElement($days),
            'created_at' => Carbon::now()->subMonths(rand(8, 10)),
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Group $group) {
            $activities = Activity::pluck('id')->toArray();
            $start_date = Carbon::parse($group->from_date)->format('Y-m-d');
            $end_date = Carbon::parse($group->to_date)->format('Y-m-d');
            while ($start_date <= $end_date) {
                if (in_array(Carbon::parse($start_date)->dayName, $group->days)) {
                    GroupDay::create([
                        'group_id' => $group->id,
                        'name' => Carbon::parse($start_date)->dayName,
                        'start_time' => Carbon::parse($start_date)->addHours(rand(6, 12)),
                        'duration' => $this->faker->randomElement([1, 2, 3]),
                        'activity_id' => $this->faker->randomElement($activities),
                        'comment' => $this->faker->realText(500)
                    ]);
                }
                $start_date = Carbon::parse($start_date)->addDay();
            }
//            $players=Player::inRandomOrder()->take(rand(10,30))->pluck('id')->toArray();
//            $coaches=Course::inRandomOrder()->take(rand(2,3))->pluck('id')->toArray();
//            $group->players()->sync($players);
//            $group->coaches()->sync($coaches);
        });
    }
}
