<?php

namespace Database\Factories;

use App\Models\Activity;
use App\Models\Course;
use App\Models\CourseDay;
use App\Models\Player;
use App\Models\Sport;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class CourseFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Course::class;

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
        $startDate = Carbon::createFromTimeStamp($this->faker->dateTimeBetween('-200 days', '+30 days')->getTimestamp());
        $endDate = Carbon::createFromFormat('Y-m-d H:i:s', $startDate)->addMonth();
        $sports=Sport::pluck('id')->toArray();
        return [
            'name' => $this->faker->title,
            'sport_id' => $this->faker->randomElement($sports),
            'from_date' => $startDate,
            'to_date' => $endDate,
            'price' => rand(100, 1000),
            'days' => $this->faker->randomElement($days),
            'created_at' => Carbon::now()->subMonths(rand(8, 10)),
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Course $course) {
            $activities = Activity::pluck('id')->toArray();
            $start_date = Carbon::parse($course->from_date)->format('Y-m-d');
            $end_date = Carbon::parse($course->to_date)->format('Y-m-d');
            while ($start_date <= $end_date) {
                if (in_array(Carbon::parse($start_date)->dayName, $course->days)) {
                    CourseDay::create([
                        'course_id' => $course->id,
                        'date' => $start_date,
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
//            $course->players()->sync($players);
//            $course->coaches()->sync($coaches);
        });
    }
}
