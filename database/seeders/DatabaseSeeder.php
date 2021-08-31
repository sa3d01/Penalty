<?php

namespace Database\Seeders;

use App\Models\Coach;
use App\Models\Course;
use App\Models\Group;
use App\Models\Player;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    /**
     * Seed the application's database.
     *
     * @return void
     */

    public function run()
    {
        $this->call(CountriesTableSeeder::class);
        $this->call(AcademySizesTableSeeder::class);
        $this->call(AdsTableSeeder::class);
        $this->call(SportsTableSeeder::class);
        $this->call(ActivitiesTableSeeder::class);
        $this->call(PermissionSeeder::class);
        $this->call(UserSeeder::class);
        $courses=Course::all();
        foreach ($courses as $course){
            $coaches=Coach::inRandomOrder()->take(rand(2,3))->pluck('id')->toArray();
            $players=Player::inRandomOrder()->take(rand(2,3))->pluck('id')->toArray();
            $course->coaches()->sync($coaches);
            $course->players()->sync($players);
        }
        $groups=Group::all();
        foreach ($groups as $group){
            $coaches=Coach::inRandomOrder()->take(rand(2,3))->pluck('id')->toArray();
            $players=Player::inRandomOrder()->take(rand(2,3))->pluck('id')->toArray();
            $group->coaches()->sync($coaches);
            $group->players()->sync($players);
        }

    }
}
